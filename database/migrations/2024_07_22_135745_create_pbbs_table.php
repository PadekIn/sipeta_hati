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
            $table->foreignId('aset_id')->constrained(table:'asets', indexName:'pbbs_aset_id_foreign');
            $table->string('no_surat', 25);
            $table->date('tanggal_surat');
            $table->string('perihal', 50);
            $table->string('keterangan', 50);
            $table->foreignId('user_id')->constrained(table: 'users', indexName: 'pbbs_user_id_foreign');
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
