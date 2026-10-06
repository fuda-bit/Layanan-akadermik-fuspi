<?php

use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PengajuanController;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/admin/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/surat-final', [\App\Http\Controllers\Admin\BerkasController::class, 'suratFinalIndex'])->name('surat-final.index');
    Route::post('/berkas/{pengajuan}/validasi/{jenis}', [PengajuanAdminController::class, 'validateFile'])->name('berkas.validasi');
    Route::get('/berkas', [PengajuanAdminController::class, 'index'])->name('berkas.index');
    Route::delete('/berkas', [PengajuanAdminController::class, 'destroyAll'])->name('berkas.destroyAll');
    Route::get('/berkas/{pengajuan}', [PengajuanAdminController::class, 'show'])->name('berkas.show');
    Route::get('/berkas/{pengajuan}/file/{jenis}', [PengajuanAdminController::class, 'file'])->name('berkas.file');
    Route::get('/berkas/{pengajuan}/pdf', [PengajuanAdminController::class, 'pdf'])->name('berkas.pdf');
    Route::get('/berkas/{pengajuan}/final', [PengajuanAdminController::class, 'downloadFinal'])->name('berkas.final');
    Route::get('/berkas/{pengajuan}/docx', [PengajuanAdminController::class, 'docx'])->name('berkas.docx');
    Route::post('/berkas/{pengajuan}/data-surat', [PengajuanAdminController::class, 'saveLetterData'])->name('berkas.dataSurat');
    Route::post('/berkas/{pengajuan}/surat-disahkan', [PengajuanAdminController::class, 'upload'])->name('berkas.upload');
    Route::delete('/berkas/{pengajuan}', [PengajuanAdminController::class, 'destroy'])->name('berkas.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [LoginController::class, 'showLoginForm']
)
    ->name('login');

Route::post(
    '/login',
    [LoginController::class, 'login']
);

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Mahasiswa - Pengajuan Surat
|--------------------------------------------------------------------------
*/

Route::get(
    '/pengajuan',
    [PengajuanController::class, 'create']
)
    ->name('pengajuan.index');

Route::get('/pengajuan/sukses', function () {

    return view('pengajuan.sukses');
})->name('pengajuan.sukses');

Route::post(
    '/pengajuan/store',
    [PengajuanController::class, 'store']
)
    ->name('pengajuan.store');


/*
|--------------------------------------------------------------------------
| Tracking
|--------------------------------------------------------------------------
*/

Route::get(
    '/tracking/{kode}',
    [PengajuanController::class, 'tracking']
)
    ->name('tracking');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {


    Route::get(
        '/dashboard',
        [AdminController::class, 'dashboard']
    )
        ->name('admin.dashboard');
});


/*
|--------------------------------------------------------------------------
| Document
|--------------------------------------------------------------------------
*/

Route::prefix('document')->group(function () {


    Route::get(
        '/',
        [DocumentController::class, 'index']
    )
        ->name('doc.index');


    Route::post(
        '/upload',
        [DocumentController::class, 'upload']
    )
        ->name('doc.upload');


    Route::get(
        '/{id}/preview',
        [DocumentController::class, 'preview']
    )
        ->name('doc.preview');


    Route::get(
        '/{id}/export-pdf',
        [DocumentController::class, 'exportPdf']
    )
        ->name('doc.pdf');


    Route::get(
        '/{id}/export-docx',
        [DocumentController::class, 'exportDocx']
    )
        ->name('doc.docx');
});

// Rute publik pemohon; tambahkan di routes/web.php di luar grup middleware admin.
Route::get('/pemohon', [\App\Http\Controllers\PemohonController::class, 'index'])->name('pemohon.index');
Route::post('/pemohon/cek', [\App\Http\Controllers\PemohonController::class, 'lookup'])->middleware('throttle:10,1')->name('pemohon.lookup');
Route::get('/pemohon/status', [\App\Http\Controllers\PemohonController::class, 'status'])->name('pemohon.status');
Route::get('/pemohon/preview', [\App\Http\Controllers\PemohonController::class, 'preview'])->middleware('throttle:30,1')->name('pemohon.preview');
Route::get('/pemohon/unduh', [\App\Http\Controllers\PemohonController::class, 'download'])->middleware('throttle:20,1')->name('pemohon.download');
