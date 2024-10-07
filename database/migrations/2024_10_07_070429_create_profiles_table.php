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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->enum('type', ['insta', 'fb'])->default('insta');
            $table->enum('status', ['1', '2', '0', '-1'])->default('0'); // 0: pending, 1: confirm, 2: deleted, -1: rejected
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->text('profile_pic')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('profile_user_id')->nullable();
            $table->integer('followers')->default('0');
            $table->integer('follows')->default('0');
            $table->integer('media')->default('0');
            $table->string('account_type')->nullable();
            $table->text('access_token')->nullable();
            $table->text('permissions')->nullable();
            $table->string('last_update_time')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
