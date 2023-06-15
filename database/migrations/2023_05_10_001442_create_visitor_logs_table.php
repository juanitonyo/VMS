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
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('visitor_id');
            $table->integer('user_id')->nullable();
            $table->integer('building_id');
            $table->integer('visitPurpose_id');
            $table->string('logType');
            $table->string('health_form')->nullable();
            $table->boolean('isCheckedOut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
