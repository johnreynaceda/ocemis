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
        Schema::create('wedding_sponsors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_info_id');
            $table->string('officiating_minister')->nullable();
            $table->string('ring_bearer')->nullable();
            $table->string('bible_bearer')->nullable();
            $table->string('coin_bearer')->nullable();
            $table->string('little_groom')->nullable();
            $table->string('little_bride')->nullable();
            $table->string('best_man')->nullable();
            $table->string('maid_of_honor')->nullable();
            $table->json('to_light_out_path')->nullable();
            $table->json('to_cloth_us_one')->nullable();
            $table->json('to_bind_us_together')->nullable();
            $table->json('grooms_man')->nullable();
            $table->json('brides_maid')->nullable();
            $table->json('flower_girls')->nullable();
            $table->json('grooms_parent')->nullable();
            $table->json('brides_parent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_sponsors');
    }
};
