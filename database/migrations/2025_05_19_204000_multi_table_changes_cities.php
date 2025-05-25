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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('image');
            $table->string('name');
            $table->string('state');
            $table->string('country');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('place_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // For storing place type like 'restaurant'
            $table->string('label')->nullable(); // Optional: for human-readable label
            $table->enum('is_active', ['0', '1'])->default('1')->comment('0 = in active, 1 = active');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('place_category_id')->constrained()->onDelete('cascade');            
            $table->string('name');
            $table->string('slug');
            $table->string('place_id')->unique();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->float('rating', 2, 1)->nullable();
            $table->integer('user_ratings_total')->nullable();
            $table->text('opening_hours')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->string('icon')->nullable();
            $table->string('category')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('reviews')->nullable(); // JSON reviews
            $table->json('photos')->nullable();           // Google photos reference
            $table->json('address_components')->nullable(); // Full parsed address parts (street, postal code, etc.)
            $table->string('vicinity')->nullable();       // Nearby area
            $table->text('editorial_summary')->nullable(); // Google's own summary if available
            $table->string('price_level')->nullable();    // Pricing info (like 1-4)
            $table->string('status')->default('pending'); // pending, success, failed
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('city_business_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('place_category_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // pending, success, failed
            $table->integer('results_count')->default(0); // how many places found
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
        Schema::dropIfExists('place_categories');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_business_categories');
    }
};
