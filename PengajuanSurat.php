<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surats';

    protected $fillable = [
        'nomor_pengajuan',
        'nama_mahasiswa',
        'nim',
        'email',
        'prodi',
        'semester',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_layanan',
        'keperluan',
        'tujuan_surat',
        'dosen_pembimbing',
        'mata_kuliah',
        'judul_skripsi',
        'tempat_penelitian',
        'file_ukt',
        'file_sk_ortu',
        'validasi_ukt',
        'validasi_sk_ortu',
        'file_pendukung',
        'surat_disahkan',
        'data_surat',
        'status',
        'tanggal_pengajuan',
    ];

    protected $casts = ['data_surat' => 'array', 'tanggal_lahir' => 'date'];
}
