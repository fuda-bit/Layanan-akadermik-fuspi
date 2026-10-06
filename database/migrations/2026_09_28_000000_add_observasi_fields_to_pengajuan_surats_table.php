<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_surats', 'dosen_pembimbing')) {
                $table->string('dosen_pembimbing')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'mata_kuliah')) {
                $table->string('mata_kuliah')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Jangan hapus kolom yang mungkin sudah ada sebelum migration ini.
    }
};
