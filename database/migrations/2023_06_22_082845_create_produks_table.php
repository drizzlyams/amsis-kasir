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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_produk')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->string('nama_produk',255);
            $table->string('merek',255);
            $table->bigInteger('harga_beli')->unsigned();
            $table->bigInteger('harga_jual')->unsigned();
            $table->integer('stock')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
