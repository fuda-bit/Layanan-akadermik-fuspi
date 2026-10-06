<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {

            $table->id();

            $table->string('nomor_pengajuan')
                ->unique();

            $table->string('nama_mahasiswa');

            $table->string('nim');

            $table->string('email');

            $table->string('prodi');


            $table->string('jenis_layanan');


            $table->text('keperluan')
                ->nullable();


            $table->string('tujuan_surat')
                ->nullable();

            $table->string('dosen_pembimbing')
                ->nullable();

            $table->string('judul_skripsi')
                ->nullable();


            $table->string('tempat_penelitian')
                ->nullable();


            $table->string('file_ukt')
                ->nullable();


            $table->string('file_sk_ortu')
                ->nullable();


            $table->string('file_pendukung')
                ->nullable();


            $table->string('status')
                ->default('diajukan');


            $table->dateTime('tanggal_pengajuan');


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
