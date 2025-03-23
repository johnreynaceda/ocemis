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
        Schema::create('baptismal_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->string('client_name');
            $table->string('pastor');
            $table->string('location');
            $table->string('contact_number');
            $table->string('baby_name');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->json('coordinator');
            $table->string('mother_name');
            $table->string('father_name');
            $table->json('singer');
            $table->json('song');
            $table->json('godparent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptismal_infos');
    }
};
