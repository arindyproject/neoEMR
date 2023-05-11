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
        Schema::create('administration_payments', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['TUNAI', 'BPJS', 'GRATIS', 'ASURANSI'])->default('TUNAI');
            $table->text('ket');



            //author----------------------------------------------------------------------
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null'); 

            $table->unsignedBigInteger('edithor_id')->nullable();
            $table->foreign('edithor_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null'); 
            $table->timestamp('deleted_at')->useCurrent()->useCurrentOnUpdate();
            //author---------------------------------------------------------------------- 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administration_payments');
    }
};
