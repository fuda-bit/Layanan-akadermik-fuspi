<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->string('validasi_ukt', 20)->nullable();
            $table->string('validasi_sk_ortu', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn(['validasi_ukt', 'validasi_sk_ortu']);
        });
    }
};
