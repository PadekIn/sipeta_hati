<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained(table: 'wargas', indexName: 'pengajuans_warga_id_foreign');
            $table->enum('jenis_surat', ['pbb', 'sporadik']);
            $table->date('tanggal');
            $table->string('perihal', 50);
            $table->string('keterangan', 50);
            $table->string('lampiran', 255);
            $table->enum('status', ['Diterima', 'Ditolak', 'Diproses']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
