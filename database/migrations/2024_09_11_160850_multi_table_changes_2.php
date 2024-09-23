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
        Schema::table('images', function (Blueprint $table) {
            $table->text('meta_description')->nullable();
        });
        Schema::table('members', function (Blueprint $table) {
            $table->enum('create_new', ['1', '0'])->default('0');
            $table->enum('directly_accepted', ['1', '0'])->default('0');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->foreignId('import_records_id')->nullable();
            $table->foreign('import_records_id')->references('id')->on('import_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function($table) {
            $table->dropColumn('meta_description');
        });
        Schema::table('images', function($table) {
            $table->dropColumn('create_new');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('directly_accepted');
            $table->dropColumn('import_records_id');
        });
    }
};
