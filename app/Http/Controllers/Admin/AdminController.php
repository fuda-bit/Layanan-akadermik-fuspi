<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            abort_unless($request->user()?->role === 'admin', 403);
            return $next($request);
        });
    }

    public function dashboard()
    {
        $jumlahPengajuan = PengajuanSurat::count();
        $jumlahSelesai = PengajuanSurat::where('status', 'selesai')
            ->whereNotNull('surat_disahkan')->count();
        $jumlahDiproses = $jumlahPengajuan - $jumlahSelesai;

        return view('admin.dashboard', compact('jumlahPengajuan', 'jumlahDiproses', 'jumlahSelesai'));
    }
}
