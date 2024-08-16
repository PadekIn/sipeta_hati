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
        Schema::create('sporadiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained(table: 'pengajuans', indexName: 'sporadiks_pengajuan_id_foreign');
            $table->foreignId('pemilik_lama_id')->constrained(table: 'wargas', indexName: 'sporadiks_pemilik_lama_id_foreign');
            $table->foreignId('pemilik_baru_id')->constrained(table:'wargas', indexName: 'sporadiks_pemilik_baru_id_foreign');
            $table->enum('jenis_barang', ['tanah', 'bangunan']);
            $table->decimal('luas', 8, 2);
            $table->string('alamat');
            $table->string('no_surat', 25);
            $table->string('jenis_surat', 15);
            $table->date('tanggal_surat');
            $table->string('lampiran', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sporadiks');
    }
};
