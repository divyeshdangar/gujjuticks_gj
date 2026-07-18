<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('card_order_items');
        Schema::dropIfExists('card_orders');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('card_categories');

        $menuIds = [22, 23, 24, 25];

        if (Schema::hasTable('menus')) {
            DB::table('menus')->whereIn('id', $menuIds)->delete();
        }

        if (Schema::hasTable('user_menus')) {
            DB::table('user_menus')->orderBy('id')->each(function ($row) use ($menuIds) {
                if ($row->menuIds === null || $row->menuIds === '') {
                    return;
                }

                $ids = array_values(array_filter(
                    array_map('intval', explode(',', $row->menuIds)),
                    fn (int $id) => $id > 0 && ! in_array($id, $menuIds, true)
                ));

                $cleaned = implode(',', $ids);

                if ($cleaned !== $row->menuIds) {
                    DB::table('user_menus')->where('id', $row->id)->update(['menuIds' => $cleaned]);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Card feature removed; recreate via historical schema if needed.
    }
};
