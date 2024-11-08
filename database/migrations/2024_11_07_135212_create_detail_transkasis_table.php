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
        Schema::create('detail_transkasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('total_pembayaran');
            $table->integer('uang_user');
            $table->integer('jumlah_kembalian')->default(0);
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transkasis');
    }
};
