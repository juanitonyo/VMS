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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->uuid('qr_id');
            $table->integer('proptech_id')->nullable();
            $table->string('building_name')->unique();
            $table->string('registration_name')->nullable();
            $table->string('logo')->nullable();
            $table->longText('description')->nullable();
            $table->longText('address')->nullable();
            $table->string('building_type')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
