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
            $table->integer('building_id');
            $table->string('firstName');
            $table->string('lastName');    
            $table->string('email');
            $table->string('password');
            $table->string('contact')->unique();
            $table->string('location');
            $table->string('gov_id');
            $table->string('frontId');
            $table->string('backId');
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
