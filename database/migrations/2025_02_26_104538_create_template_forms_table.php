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
        Schema::create('template_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable();
            $table->string('type');
            $table->string('title');
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->enum('editable', ['1', '0'])->default('0');
            $table->string('image')->nullable()->default('default.png');
            $table->foreign('template_id')->references('id')->on('template');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_forms');
    }
};
