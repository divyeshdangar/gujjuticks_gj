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
        Schema::create('instagram_post_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_set_id')->constrained()->onDelete('cascade');
            $table->string('instagram_post_id')->nullable(); // IG post reference
            $table->string('status')->default('pending');    // pending, posted, failed
            $table->text('error_message')->nullable();       // store API errors if any
            $table->timestamps();

            $table->unique(['user_id', 'post_set_id']); // one link per user/post set
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_post_sets');
    }
};
