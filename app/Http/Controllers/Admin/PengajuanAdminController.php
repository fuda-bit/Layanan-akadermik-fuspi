<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Support\SuratResmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\TemplateProcessor;

class PengajuanAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function (Request $request, $next) {
            abort_unless($request->user()?->role === 'admin', 403);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.pengajuan.index', ['pengajuan' => PengajuanSurat::latest('id')->paginate(20)]);
    }

    public function show(PengajuanSurat $pengajuan)
    {
        abort_unless(in_array($pengajuan->jenis_layanan, SuratResmi::JENIS, true), 422);
        $surat = SuratResmi::values($pengajuan);
        $tanggalMagang = SuratResmi::suggestedMagangDates($pengajuan);
        $kop = base64_encode(file_get_contents(storage_path('app/templates/surat/kop.jpeg')));
        return view('admin.pengajuan.show', compact('pengajuan', 'surat', 'kop', 'tanggalMagang'));
    }

    public function saveLetterData(Request $request, PengajuanSurat $pengajuan)
    {
        abort_unless(in_array($pengajuan->jenis_layanan, SuratResmi::JENIS, true), 422);
        $data = $request->validate(SuratResmi::rules($pengajuan->jenis_layanan) + [
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'semester' => 'required|string|max:30',
            'dosen_pembimbing' => in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true)
                ? 'required|string|max:255' : 'nullable|string|max:255',
        ]);
        $identitas = array_intersect_key($data, array_flip(['tempat_lahir', 'tanggal_lahir', 'semester', 'dosen_pembimbing']));
        $pengajuan->update($identitas + ['data_surat' => array_diff_key($data, $identitas)]);
        return back()->with('success', 'Data surat resmi disimpan.');
    }

    public function file(PengajuanSurat $pengajuan, string $jenis)
    {
        abort_unless(in_array($jenis, ['file_ukt', 'file_sk_ortu', 'file_pendukung', 'surat_disahkan'], true), 404);
        $disk = $jenis === 'surat_disahkan' ? 'local' : 'public';
        $path = $pengajuan->{$jenis};
        abort_unless($path && Storage::disk($disk)->exists($path), 404);
        return Storage::disk($disk)->response($path);
    }

    public function validateFile(Request $request, PengajuanSurat $pengajuan, string $jenis)
    {
        abort_unless(in_array($jenis, ['file_ukt', 'file_sk_ortu'], true), 404);
        $data = $request->validate(['keputusan' => 'required|in:valid,perlu_perbaikan']);
        abort_unless($pengajuan->{$jenis} && Storage::disk('public')->exists($pengajuan->{$jenis}), 422, 'Berkas belum tersedia.');
        $column = $jenis === 'file_ukt' ? 'validasi_ukt' : 'validasi_sk_ortu';
        $pengajuan->update([$column => $data['keputusan']]);
        return back()->with('success', 'Validasi berkas berhasil disimpan.');
    }

    public function pdf(PengajuanSurat $pengajuan)
    {
        $this->ensureReady($pengajuan);
        $surat = SuratResmi::values($pengajuan);
        $kop = base64_encode(file_get_contents(storage_path('app/templates/surat/kop.jpeg')));
        $isPdf = true;
        return Pdf::loadView('admin.pengajuan.surat', compact('pengajuan', 'surat', 'kop', 'isPdf'))
            ->setPaper('a4')->download('surat-'.$pengajuan->id.'.pdf');
    }

    public function downloadFinal(PengajuanSurat $pengajuan)
    {
        abort_unless(
            $pengajuan->surat_disahkan
                && Storage::disk('local')->exists($pengajuan->surat_disahkan),
            404,
            'Surat final belum tersedia.'
        );

        return Storage::disk('local')->download(
            $pengajuan->surat_disahkan,
            'surat-final-'.$pengajuan->id.'.pdf',
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }

    public function docx(PengajuanSurat $pengajuan)
    {
        $this->ensureReady($pengajuan);
        $templatePath = storage_path('app/templates/surat/'.$pengajuan->jenis_layanan.'.docx');
        abort_unless(is_file($templatePath), 500, 'Template surat belum terpasang.');
        $template = new TemplateProcessor($templatePath);
        $template->setValues(SuratResmi::values($pengajuan));
        $path = tempnam(sys_get_temp_dir(), 'fuspi-docx-');
        $template->saveAs($path);
        return response()->download($path, 'surat-'.$pengajuan->id.'.docx')->deleteFileAfterSend(true);
    }

    public function upload(Request $request, PengajuanSurat $pengajuan)
    {
        $this->ensureReady($pengajuan);
        $request->validate(['surat_disahkan' => 'required|file|mimes:pdf|max:10240']);
        $path = $request->file('surat_disahkan')->store('surat-disahkan', 'local');
        $old = $pengajuan->surat_disahkan;
        $pengajuan->update(['surat_disahkan' => $path, 'status' => 'selesai']);
        if ($old) Storage::disk('local')->delete($old);

        try {
            $attachment = Storage::disk('local')->path($path);
            Mail::raw(
                'Permohonan surat nomor '.$pengajuan->nomor_pengajuan.' telah selesai. Surat yang sudah disahkan terlampir. Anda juga dapat mengunduhnya melalui menu Akses Pemohon pada situs FUSPI.',
                function ($message) use ($pengajuan, $attachment) {
                    $message->to($pengajuan->email)
                        ->subject('Surat permohonan FUSPI selesai - '.$pengajuan->nomor_pengajuan)
                        ->attach($attachment, ['as' => 'surat-'.$pengajuan->id.'.pdf', 'mime' => 'application/pdf']);
                }
            );
        } catch (\Throwable $e) {
            Log::error('Pengiriman surat FUSPI gagal', ['pengajuan_id' => $pengajuan->id, 'exception' => $e]);
            return back()->withErrors(['email' => 'Surat berhasil diunggah dan tersedia untuk diunduh, tetapi email gagal terkirim. Periksa pengaturan MAIL di .env lalu unggah ulang surat untuk mencoba lagi.']);
        }
        return back()->with('success', 'Surat disahkan berhasil diunggah dan dikirim ke email mahasiswa.');
    }

    public function destroy(PengajuanSurat $pengajuan)
    {
        $paths = $this->paths($pengajuan);
        $pengajuan->delete();
        $this->deleteFiles($paths);
        return redirect()->route('admin.berkas.index')->with('success', 'Pengajuan dihapus.');
    }

    public function destroyAll(Request $request)
    {
        $request->validate(['confirmation' => 'required|in:HAPUS SEMUA']);
        // Penghapusan massal harus selesai di database sebelum berkas dihapus.
        $paths = [];
        PengajuanSurat::orderBy('id')->chunkById(100, function ($items) use (&$paths) {
            foreach ($items as $item) $paths[] = $this->paths($item);
        });
        PengajuanSurat::query()->delete();
        foreach ($paths as $set) $this->deleteFiles($set);
        return redirect()->route('admin.berkas.index')->with('success', 'Semua pengajuan dihapus.');
    }

    private function paths(PengajuanSurat $item): array
    {
        return [$item->file_ukt, $item->file_sk_ortu, $item->file_pendukung, $item->surat_disahkan];
    }

    private function ensureValidated(PengajuanSurat $pengajuan): void
    {
        $validUkt = $pengajuan->validasi_ukt === 'valid'
            && $pengajuan->file_ukt
            && Storage::disk('public')->exists($pengajuan->file_ukt);
        $requiresSk = $pengajuan->jenis_layanan === 'aktif_kuliah_tunjangan_ortu';
        $validSk = ! $requiresSk || ($pengajuan->validasi_sk_ortu === 'valid'
            && $pengajuan->file_sk_ortu
            && Storage::disk('public')->exists($pengajuan->file_sk_ortu));
        abort_unless($validUkt && $validSk, 403, 'Validasi dahulu semua berkas wajib yang tersedia.');
    }

    private function ensureReady(PengajuanSurat $pengajuan): void
    {
        $this->ensureValidated($pengajuan);
        abort_unless(in_array($pengajuan->jenis_layanan, SuratResmi::JENIS, true)
            && SuratResmi::complete($pengajuan), 422, 'Lengkapi data surat resmi sebelum ekspor.');
    }

    private function deleteFiles(array $paths): void
    {
        foreach (array_slice($paths, 0, 3) as $path) if ($path) Storage::disk('public')->delete($path);
        if ($paths[3]) Storage::disk('local')->delete($paths[3]);
    }

}
