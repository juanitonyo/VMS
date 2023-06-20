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
            $table->string('firstName');
            $table->string('lastName');    
            $table->string('email');
            $table->string('password');
            $table->string('contact')->nullable()->unique();
            $table->longText('location')->nullable();
            $table->string('profilePhoto')->nullable();
            $table->string('gov_id')->nullable();
            $table->string('frontId')->nullable();
            $table->string('backId')->nullable();
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
