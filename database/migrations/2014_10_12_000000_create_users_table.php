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
        $address = [
            "use"       => "",
            "type"      => "",
            "text"      => "",
            "line"      => "",
            "city"      => "",
            "district"  => "",
            "state"     => "",
            "postalCode"=> "",
            "country"   => "",
            "peroide"   => [
                "start" => "",
                "end"   => ""
            ]
            ];
        Schema::create('users', function (Blueprint $table) use($address) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->integer('level')->default(0);
            $table->integer('status')->default(0);


            
            $table->string('gender')->nullable();
            $table->text('address_alamat')->nullable();
            
            $table->date('birthDate')->nullable();
            $table->text('photo')->nullable();
            $table->text('signature')->nullable();


            $table->string('no_tlp')->nullable();
            $table->string('tempat_lahir')->nullable();
            
            $table->json('identifier')->nullable();
            $table->json('telecom')->nullable();
            $table->json('address')->nullable();
            $table->json('communication')->nullable();

            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
