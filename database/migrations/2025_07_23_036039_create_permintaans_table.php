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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            // $table->string('no_surat');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('kode_barang');
            // $table->foreignId('id_role')->constrained('roles');
            $table->string('keterangan_1')->nullable();
            $table->string('keterangan_2')->nullable();
            $table->string('keterangan_3')->nullable();
            $table->string('keterangan_4')->nullable();
            $table->foreignId('id_verifikasi')->nullable()->constrained('verifikasis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
