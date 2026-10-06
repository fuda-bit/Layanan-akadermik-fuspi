<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemohonController extends Controller
{
    public function index()
    {
        return view('pemohon.index');
    }

    public function lookup(Request $request)
    {
        $data = $request->validate(['nomor_pengajuan' => ['required', 'string', 'max:120']]);
        $nomor = trim($data['nomor_pengajuan']);
        $pengajuan = PengajuanSurat::where('nomor_pengajuan', $nomor)->first();

        if (!$pengajuan) {
            return back()->withInput()->withErrors([
                'nomor_pengajuan' => 'Nomor pengajuan tidak ditemukan. Periksa kembali nomor pada bukti pengajuan.'
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('pemohon_pengajuan_id', $pengajuan->id);

        return redirect()->route('pemohon.status');
    }

    public function status(Request $request)
    {
        $id = $request->session()->get('pemohon_pengajuan_id');

        if (!$id) {
            return redirect()->route('pemohon.index');
        }

        $pengajuan = PengajuanSurat::find($id);

        if (!$pengajuan) {
            $request->session()->forget('pemohon_pengajuan_id');
            return redirect()->route('pemohon.index');
        }

        $siap = $pengajuan->status === 'selesai'
            && $pengajuan->surat_disahkan
            && Storage::disk('local')->exists($pengajuan->surat_disahkan);

        return view('pemohon.status', compact('pengajuan', 'siap'));
    }

    public function preview(Request $request)
    {
        $id = $request->session()->get('pemohon_pengajuan_id');
        abort_unless($id, 403);

        $pengajuan = PengajuanSurat::findOrFail($id);

        abort_unless(
            $pengajuan->status === 'selesai'
            && $pengajuan->surat_disahkan
            && Storage::disk('local')->exists($pengajuan->surat_disahkan),
            404
        );

        return Storage::disk('local')->response(
            $pengajuan->surat_disahkan,
            'surat-'.$pengajuan->id.'.pdf',
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="surat-'.$pengajuan->id.'.pdf"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function download(Request $request)
    {
        $id = $request->session()->get('pemohon_pengajuan_id');
        abort_unless($id, 403);

        $pengajuan = PengajuanSurat::findOrFail($id);

        abort_unless(
            $pengajuan->status === 'selesai'
            && $pengajuan->surat_disahkan
            && Storage::disk('local')->exists($pengajuan->surat_disahkan),
            404
        );

        return Storage::disk('local')->download(
            $pengajuan->surat_disahkan,
            'surat-'.$pengajuan->id.'.pdf'
        );
    }
}
