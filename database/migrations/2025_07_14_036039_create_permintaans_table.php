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
            $table->string('no_surat');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->foreignId('id_stock_opname')->constrained('stock_opnames');
            // $table->foreignId('id_role')->constrained('roles');
            $table->string('status');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_bidang')->constrained('bidangs');
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
