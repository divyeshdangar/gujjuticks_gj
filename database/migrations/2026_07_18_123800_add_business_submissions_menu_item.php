<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::table('menus')->where('id', 27)->exists();

        $row = [
            'icon' => 'briefcase',
            'title' => 'dashboard.business_submissions',
            'route' => 'dashboard.business',
            'order' => 11,
            'title_only' => '0',
            'type' => '2',
            'status' => '1',
            'updated_at' => now(),
        ];

        if ($exists) {
            DB::table('menus')->where('id', 27)->update($row);
        } else {
            DB::table('menus')->insert(array_merge($row, [
                'id' => 27,
                'created_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        DB::table('menus')->where('id', 27)->delete();
    }
};
