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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('member_id')->nullable();
            $table->string('email');
            $table->integer('total_request')->default(1); // to allow user only few time to request
            $table->enum('status', ['1', '2', '0', '-1'])->default('0'); // 0: pending, 1: confirm, 2: deleted, -1: rejected
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
