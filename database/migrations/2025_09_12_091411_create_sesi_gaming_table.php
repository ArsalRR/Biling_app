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
        Schema::create('sesi_gaming', function (Blueprint $table) {
            $table->id();
             $table->foreignId('paket_id')->constrained('paket')->onDelete('cascade');
             $table->foreignId('ps_id')->constrained('ps')->onDelete('cascade');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['aktif', 'selesai', 'batal'])->default('aktif');
            $table->boolean('tv_dimatikan')->default(false);
            $table->text('respon_shutdown')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
                  $table->index('status');
            $table->index('waktu_mulai');
            $table->index('waktu_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_gaming');
    }
};
