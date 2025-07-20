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
        Schema::create('resume_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('place');
            $table->string('city')->nullable();
            $table->string('start_month');
            $table->string('start_year');
            $table->string('end_month')->nullable();
            $table->string('end_year')->nullable();
            $table->boolean('is_ongoing')->default(false);
            $table->text('experience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_experiences');
    }
};
