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
        Schema::create('expected_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('courier_name');
            $table->integer('building_id');
            $table->integer('user_id');
            $table->string('remarks')->nullable();
            $table->boolean('status')->default(true);
            $table->dateTime('target_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expected_deliveries');
    }
};
