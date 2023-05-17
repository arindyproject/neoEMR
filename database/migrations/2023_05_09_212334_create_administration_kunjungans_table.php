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
        Schema::create('administration_kunjungans', function (Blueprint $table) {
            $table->id();

            $table->string('antrian_urut');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('CASCADE'); 

            //----
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('administration_payments')->onDelete('set null'); 

            $table->timestamp('tgl_mendaftar');
            $table->date('tgl_pemeriksaan');
            //----


            //---
            $table->string('type_kunjungan'); //KUNJUNGAN_SEHAT , KUNJUNGAN_SAKIT
            $table->string('type_layanan'); //RAJAL, RANAP , IGD
            //---


            $table->boolean('is_online')->default(0);

            //cekin-----------------------------------------------------------------------
            $table->boolean('is_cekin')->default(0);
            $table->timestamp('cekin_at')->nullable();
            //cekin-----------------------------------------------------------------------

            //author----------------------------------------------------------------------
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null'); 

            $table->unsignedBigInteger('edithor_id')->nullable();
            $table->foreign('edithor_id')->references('id')->on('users')->onDelete('set null');

            $table->text('alasan_menghapus')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null'); 
            $table->timestamp('deleted_at')->nullable();
            //author---------------------------------------------------------------------- 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administration_kunjungans');
    }
};
