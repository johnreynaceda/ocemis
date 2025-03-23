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
        Schema::create('wedding_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->string('client_name')->nullable();
            $table->string('host_pastor')->nullable();
            $table->string('reception')->nullable();
            $table->string('contact_number')->nullable();
            $table->date('scheduled_practice')->nullable();
            $table->string('groom_name')->nullable();
            $table->string('bride_name')->nullable();
            $table->json('coordinator')->nullable();
            $table->json('singer')->nullable();
            $table->json('song')->nullable();
            $table->json('principal_sponsor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_infos');
    }
};
