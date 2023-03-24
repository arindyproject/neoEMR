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
        Schema::create('att_alamat_kecamatans', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->nullable();
            $table->string('kode_kecamatan')->nullable();
            $table->string('nama');

            $table->unsignedBigInteger('att_alamat_kotas_id');
            $table->foreign('att_alamat_kotas_id')->references('id')->on('att_alamat_kotas')->onDelete('CASCADE'); 


            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('att_alamat_kecamatans');
    }
};
