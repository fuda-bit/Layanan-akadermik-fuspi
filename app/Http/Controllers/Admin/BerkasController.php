<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;

class BerkasController extends Controller
{
    public function index()
    {
        return view('admin.berkas.index');
    }

    public function suratFinalIndex()
    {
        $pengajuans = PengajuanSurat::latest('id')->paginate(20);

        return view('admin.pengajuan.upload-final', compact('pengajuans'));
    }
}
