<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_customer')->nullable();
            $table->string('email')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['Belum Bayar', 'Sudah Bayar'])->default('Belum Bayar');
            $table->boolean('reminder_sent')->default(false);
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Hapus tabel saat rollback
        Schema::dropIfExists('transaksi');
    }
}
