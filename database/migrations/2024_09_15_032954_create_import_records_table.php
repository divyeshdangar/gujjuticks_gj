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
        Schema::create('import_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('model');
            $table->string('file');
            $table->integer('success_count')->nullable();
            $table->integer('failed_count')->nullable();
            $table->text('notes')->nullable();
            $table->string('file_original_name');
            $table->enum('status', ['1', '2', '0', '-1'])->default('0'); // 0: pending, 1: confirm, 2: deleted, -1: rejected
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_records');
    }
};
