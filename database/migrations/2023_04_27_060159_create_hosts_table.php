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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->json('building_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');    
            $table->string('email');
            $table->string('password');
            $table->string('contact')->unique();
            $table->string('location');
            $table->string('profile_photo');
            $table->string('gov_id');
            $table->string('front_id');
            $table->string('back_id');
            $table->boolean('policy')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
};
