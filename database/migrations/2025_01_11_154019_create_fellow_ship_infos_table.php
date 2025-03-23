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
        Schema::create('fellow_ship_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('music_in_charge')->nullable();
            $table->string('program_in_charge')->nullable();
            $table->date('date')->nullable();
            $table->json('coordinators')->nullable();
            $table->string('master_of_ceremony')->nullable();
            $table->string('speaker')->nullable();
            $table->json('songs')->nullable();
            $table->json('participants')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fellow_ship_infos');
    }
};
