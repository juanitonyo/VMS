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
            $table->string('building_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');    
            $table->string('email');
            $table->string('contact')->nullable()->unique();
            $table->string('location')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('gov_id')->nullable();
            $table->string('front_id')->nullable();
            $table->string('back_id')->nullable();
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
