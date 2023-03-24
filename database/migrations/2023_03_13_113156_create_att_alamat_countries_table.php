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
        Schema::create('att_alamat_countries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('nama');

            $table->string('alpha_2')->unique();
            $table->string('alpha_3')->unique();
            $table->string('country_code')->unique();

            $table->string('iso_3166_2')->nullable();
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->string('intermediate_region')->nullable();
            $table->string('region_code')->nullable();
            $table->string('sub_region_code')->nullable();
            $table->string('intermediate_region_code')->nullable();

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
        Schema::dropIfExists('att_alamat_countries');
    }
};
