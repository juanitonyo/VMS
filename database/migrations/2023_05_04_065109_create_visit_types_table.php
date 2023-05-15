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
        Schema::create('visit_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('buildingType');
            $table->longText('description');
            $table->boolean('personToVisit');
            $table->boolean('visitApproval');
            $table->boolean('autoApprove');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_types');
    }
};