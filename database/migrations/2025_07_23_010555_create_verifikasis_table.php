<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verifikasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('status')->nullable();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_bidang')->constrained('bidangs');
            $table->string('menyetujui')->nullable();
            $table->date('tanggal_acc')->nullable();
            $table->string('ttd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasis');
    }
};
