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
            $table->foreignId('id_stock_opname')->constrained('stock_opnames');
            // $table->foreignId('id_role')->constrained('roles');
            $table->string('keterangan')->nullable();
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
