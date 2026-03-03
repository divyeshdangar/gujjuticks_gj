<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('update_posts', function (Blueprint $table) {
            $table->string('public_id', 20)->nullable()->after('slug');
            $table->unique('public_id');
        });

        DB::table('update_posts')
            ->select('id')
            ->orderBy('id')
            ->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    do {
                        $token = Str::lower(Str::random(10));
                    } while (DB::table('update_posts')->where('public_id', $token)->exists());

                    DB::table('update_posts')
                        ->where('id', $row->id)
                        ->update(['public_id' => $token]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('update_posts', function (Blueprint $table) {
            $table->dropUnique(['public_id']);
            $table->dropColumn('public_id');
        });
    }
};

