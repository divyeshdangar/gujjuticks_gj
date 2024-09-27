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
        Schema::create('days', function (Blueprint $table) {
            $table->id();            
            $table->enum('type', ['history', 'fix', 'non-fix', 'news', 'event', 'wish'])->default('fix');
            $table->string('image')->nullable()->default('default.png');
            $table->string('image_g')->nullable()->default('default.png');
            $table->string('image_h')->nullable()->default('default.png');
            $table->string('slug')->index();
            $table->string('day')->index();
            $table->string('day_g')->nullable();
            $table->string('day_h')->nullable();
            $table->string('month')->index();
            $table->string('month_g')->nullable();
            $table->string('month_h')->nullable();
            $table->string('year')->index();
            $table->string('year_g')->nullable();
            $table->string('year_h')->nullable();
            $table->string('title');
            $table->string('title_g')->nullable();
            $table->string('title_h')->nullable();
            $table->text('description')->nullable();
            $table->text('description_g')->nullable();
            $table->text('description_h')->nullable();
            $table->text('extra')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
