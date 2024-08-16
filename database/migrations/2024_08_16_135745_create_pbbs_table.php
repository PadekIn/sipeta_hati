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
        Schema::create('pbbs', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_barang', ['tanah', 'bangunan']);
            $table->decimal('luas', 8, 2);
            $table->string('alamat');
            $table->string('no_surat', 25);
            $table->date('tanggal_surat');
            $table->string('lampiran', 255);
            $table->foreignId('pengajuan_id')->constrained(table: 'pengajuans', indexName: 'pbbs_pengajuan_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pbbs');
    }
};
