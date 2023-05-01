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
        Schema::create('patient_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('CASCADE'); 

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file');
            $table->text('ket')->nullable();
            $table->boolean('by_patient')->default(0);

            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null'); 

            $table->unsignedBigInteger('edithor_id')->nullable();
            $table->foreign('edithor_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_files');
    }
};
