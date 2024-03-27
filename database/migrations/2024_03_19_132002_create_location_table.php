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
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_gj')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->text('description_gj')->nullable();
            $table->longText('details')->nullable();
            $table->longText('details_gj')->nullable();
            $table->string('url');
            $table->string('lgd');
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
