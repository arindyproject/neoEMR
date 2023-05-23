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
        Schema::create('att_kepegawaian_profesis', function (Blueprint $table) {
            $table->id();

            $table->string('nama_profesi');
            $table->text('ket')->nullable();
            $table->integer('poin')->default(0);
            $table->string('jenis_profesi');
            $table->json('log')->nullable();


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
        Schema::dropIfExists('att_kepegawaian_profesis');
    }
};
