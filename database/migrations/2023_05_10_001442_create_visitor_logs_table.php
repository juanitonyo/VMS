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
            $table->integer('visit_purpose_id');
            $table->string('log_type');
            $table->string('checked_in_by')->nullable();
            $table->string('checked_out_by')->nullable();
            $table->string('health_form')->nullable();
            $table->boolean('is_checked_out')->default(false);
            $table->integer('status')->default(0);
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
