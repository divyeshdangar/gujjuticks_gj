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
        Schema::dropIfExists('work_item_comments');
        Schema::dropIfExists('work_item_histories');
        Schema::dropIfExists('work_items');
        Schema::dropIfExists('work_item_categories');
        Schema::dropIfExists('board_users');
        Schema::dropIfExists('boards');

        Schema::dropIfExists('members');
        Schema::dropIfExists('import_records');

        $menuIds = [2, 3, 4];

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

        if (Schema::hasTable('notifications')) {
            DB::table('notifications')->where('message_tag', 'msg.new_member_request')->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Board and Member features removed; recreate via historical schema if needed.
    }
};
