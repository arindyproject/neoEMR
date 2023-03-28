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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();

            //-----------------------------------------------------------
            $table->string('full_name');

            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('att_jenis_kelamins')->onDelete('set null'); 
            
            $table->string('place_of_birth')->nullable();
            $table->date('birthDate')->nullable();

            $table->unsignedBigInteger('identity_type_id')->nullable();
            $table->foreign('identity_type_id')->references('id')->on('att_jenis_kartu_identitas')->onDelete('set null'); 
            $table->string('identity_number')->nullable()->unique();

            $table->unsignedBigInteger('maritalStatus_id')->nullable();
            $table->foreign('maritalStatus_id')->references('id')->on('att_jenis_pernikahans')->onDelete('set null'); 
           

            $table->string('photo')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_tlp')->nullable();
            //-----------------------------------------------------------
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->foreign('agama_id')->references('id')->on('att_jenis_agamas')->onDelete('set null'); 

            $table->string('nama_ibu')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('suku')->nullable();

            $table->unsignedBigInteger('kewarganegaraan_id')->nullable();
            $table->foreign('kewarganegaraan_id')->references('id')->on('att_alamat_countries')->onDelete('set null');
            
            $table->unsignedBigInteger('pendidikan_id')->nullable();
            $table->foreign('pendidikan_id')->references('id')->on('att_jenis_pendidikans')->onDelete('set null'); 
            
            $table->unsignedBigInteger('pekerjaan_id')->nullable();
            $table->foreign('pekerjaan_id')->references('id')->on('att_jenis_pekerjaans')->onDelete('set null'); 
            //-----------------------------------------------------------


            //-----------------------------------------------------------
            $table->string('postalCode')->nullable();
            $table->text('address_alamat');

            $table->unsignedBigInteger('address_provinsi_id')->nullable();
            $table->foreign('address_provinsi_id')->references('id')->on('att_alamat_provinsis')->onDelete('set null');
            
            $table->unsignedBigInteger('address_kota_id')->nullable();
            $table->foreign('address_kota_id')->references('id')->on('att_alamat_kotas')->onDelete('set null'); 
            
            $table->unsignedBigInteger('address_kecamatan_id')->nullable();
            $table->foreign('address_kecamatan_id')->references('id')->on('att_alamat_kecamatans')->onDelete('set null');
            
            $table->unsignedBigInteger('address_kelurahan_id')->nullable();
            $table->foreign('address_kelurahan_id')->references('id')->on('att_alamat_kelurahans')->onDelete('set null');
            //-----------------------------------------------------------


            //-----------------------------------------------------------
            $table->json('name')->nullable();
            $table->json('identifier')->nullable();
            $table->json('communication')->nullable();
            $table->json('address')->nullable();
            $table->json('telecom')->nullable();
            $table->json('contact')->nullable();
            $table->json('deceased')->nullable();
            //-----------------------------------------------------------



            //-----------------------------------------------------------
            $table->string('blood')->nullable();
            $table->text('note')->nullable();
            //-----------------------------------------------------------


            //-----------------------------------------------------------
            $table->boolean('active')->default(false);

            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null'); 

            $table->unsignedBigInteger('edithor_id')->nullable();
            $table->foreign('edithor_id')->references('id')->on('users')->onDelete('set null'); 
            //-----------------------------------------------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
