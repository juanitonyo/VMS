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
        Schema::create('invitation_logs', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('user_id');
            $table->string('building_id');
            $table->string('visit_purpose_id');
            $table->string('ref_code');
            $table->string('location');
            $table->string('contact');
            $table->integer('status')->default(0);
            $table->string('companions')->nullable();
            $table->dateTime('target_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_logs');
    }
};
