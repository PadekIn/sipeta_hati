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
        Schema::create('saparodiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_lama_id')->constrained(table: 'warga', indexName: 'saparodiks_pemilik_lama_id_foreign');
            $table->foreignId('pemilik_baru_id')->constrained(table:'warga', indexName: 'saparodiks_pemilik_baru_id_foreign');
            $table->foreignId('aset_id')->constrained(table:'aset', indexName: 'saparodiks_aset_id_foreign');
            $table->string('no_surat', 25);
            $table->string('jenis_surat', 15);
            $table->date('tanggal_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saparodiks');
    }
};
