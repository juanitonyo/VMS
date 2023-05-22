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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_ID');
            $table->integer('building_ID')->nullable();
            $table->string('email');
            $table->string('name');
            $table->string('contact')->nullable();
            $table->string('validId')->nullable();
            $table->string('google_id')->nullable();
            $table->string('profilePhoto')->nullable();
            $table->string('front_id')->nullable();;
            $table->string('back_id')->nullable();;
            $table->boolean('status')->default(false);
            $table->boolean('policy')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
