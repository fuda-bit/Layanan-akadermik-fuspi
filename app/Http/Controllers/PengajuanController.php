<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PengajuanController extends Controller
{

    /**
     * Form pengajuan mahasiswa
     */
    public function create()
    {
        return view('form_pengajuan');
    }



    /**
     * Simpan pengajuan
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama_mahasiswa' => 'required|string|max:100',
            'nim' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'prodi' => 'required|string|max:255',
            'semester' => 'required|string|max:30',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_layanan' => 'required|in:aktif_kuliah_umum,aktif_kuliah_tunjangan_ortu,magang,observasi,penelitian,rekomendasi',
            'keperluan' => 'required_unless:jenis_layanan,penelitian|nullable|string|max:2000',
            'tujuan_surat' => 'required_if:jenis_layanan,magang,observasi,penelitian,rekomendasi|nullable|string|max:255',
            'dosen_pembimbing' => 'required_if:jenis_layanan,magang,observasi|nullable|string|max:255',
            'mata_kuliah' => 'required_if:jenis_layanan,observasi|nullable|string|max:255',
            'judul_skripsi' => 'required_if:jenis_layanan,penelitian|nullable|string|max:255',
            'tempat_penelitian' => 'required_if:jenis_layanan,penelitian|nullable|string|max:255',
            'file_ukt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_sk_ortu' => 'required_if:jenis_layanan,aktif_kuliah_tunjangan_ortu|nullable|file|mimes:pdf|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | GENERATE NOMOR PENGAJUAN
        |--------------------------------------------------------------------------
        */


        $nomor =
            'FUSPI/' .
            date('Y') .
            '/' .
            str_pad(

                PengajuanSurat::count() + 1,

                4,

                '0',

                STR_PAD_LEFT

            );




        /*
        |--------------------------------------------------------------------------
        | DATA UTAMA
        |--------------------------------------------------------------------------
        */


        $data = [

            'nomor_pengajuan'
            =>
            $nomor,

            'nama_mahasiswa'
            =>
            $request->nama_mahasiswa,


            'nim'
            =>
            $request->nim,


            'email'
            =>
            $request->email,


            'prodi'
            =>
            $request->prodi,
            'semester' => $request->semester,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,


            'jenis_layanan'
            =>
            $request->jenis_layanan,


            'keperluan'
            =>
            $request->jenis_layanan === 'penelitian' ? null : $request->keperluan,

            'dosen_pembimbing'
            =>
            in_array($request->jenis_layanan, ['magang', 'observasi'], true) ? $request->dosen_pembimbing : null,

            'mata_kuliah' => $request->jenis_layanan === 'observasi' ? $request->mata_kuliah : null,

            'tujuan_surat'
            =>
            in_array($request->jenis_layanan, ['magang', 'observasi', 'penelitian', 'rekomendasi'], true) ? $request->tujuan_surat : null,



            'judul_skripsi'
            =>
            $request->jenis_layanan === 'penelitian' ? $request->judul_skripsi : null,



            'tempat_penelitian'
            =>
            $request->jenis_layanan === 'penelitian' ? $request->tempat_penelitian : null,



            'status'
            =>
            'diajukan',



            'tanggal_pengajuan'
            =>
            Carbon::now()


        ];






        /*
        |--------------------------------------------------------------------------
        | UPLOAD FILE UKT
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('file_ukt')) {


            $file =
                $request->file('file_ukt');



            $namaFile =

                'UKT_' .

                time() .

                '_' .

                Str::random(10)

                .

                '.' .

                $file->extension();




            $path =

                $file->storeAs(

                    'dokumen/ukt',

                    $namaFile,

                    'public'

                );



            $data['file_ukt']
                =
                $path;
        }







        /*
        |--------------------------------------------------------------------------
        | UPLOAD SK ORANG TUA
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('file_sk_ortu')) {


            $file =
                $request->file('file_sk_ortu');



            $namaFile =

                'SK_ORTU_' .

                time() .

                '_' .

                Str::random(10)

                .

                '.' .

                $file->extension();





            $path =

                $file->storeAs(

                    'dokumen/sk_ortu',

                    $namaFile,

                    'public'

                );



            $data['file_sk_ortu']
                =
                $path;
        }







        /*
        |--------------------------------------------------------------------------
        | UPLOAD FILE PENDUKUNG
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('file_pendukung')) {


            $file =
                $request->file('file_pendukung');



            $namaFile =

                'PENDUKUNG_' .

                time() .

                '_' .

                Str::random(10)

                .

                '.' .

                $file->extension();




            $path =

                $file->storeAs(

                    'dokumen/lainnya',

                    $namaFile,

                    'public'

                );



            $data['file_pendukung']
                =
                $path;
        }





        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATABASE
        |--------------------------------------------------------------------------
        */


        PengajuanSurat::create($data);





        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */


        return redirect()

            ->route('pengajuan.sukses')

            ->with([

                'success' =>

                'Pengajuan berhasil dikirim',

                'nomor' =>

                $nomor

            ]);
    }







    /**
     * Detail pengajuan
     */
    public function show($id)
    {


        $data =

            PengajuanSurat::findOrFail($id);



        return view(

            'pengajuan.detail',

            compact('data')

        );
    }






    /**
     * Hapus pengajuan
     */
    public function destroy($id)
    {


        $data =

            PengajuanSurat::findOrFail($id);



        /*
        hapus file
        */

        if ($data->file_ukt) {

            Storage::disk('public')
                ->delete($data->file_ukt);
        }


        if ($data->file_sk_ortu) {

            Storage::disk('public')
                ->delete($data->file_sk_ortu);
        }



        $data->delete();



        return back()

            ->with(

                'success',

                'Data berhasil dihapus'

            );
    }
}
