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
        Schema::create('att_alamat_kotas', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->nullable();
            $table->string('kode_kota')->nullable();
            $table->string('nama');


            $table->unsignedBigInteger('att_alamat_provinsis_id');
            $table->foreign('att_alamat_provinsis_id')->references('id')->on('att_alamat_provinsis')->onDelete('CASCADE'); 


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
        Schema::dropIfExists('att_alamat_kotas');
    }
};
