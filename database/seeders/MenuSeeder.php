<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Menu::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                "id" => 1, 
                "icon" => "grid", 
                "title" => 'dashboard.dashboard', 
                "route" => "dashboard",
                "order" => 1,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 2, 
                "icon" => "", 
                "title" => 'dashboard.manage_work', 
                "route" => "",
                "order" => 2,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 3, 
                "icon" => "clipboard", 
                "title" => 'dashboard.board', 
                "route" => "dashboard.board",
                "order" => 3,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 4, 
                "icon" => "user", 
                "title" => 'dashboard.member', 
                "route" => "dashboard.member",
                "order" => 4,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 16, 
                "icon" => "square", 
                "title" => 'dashboard.posts', 
                "route" => "dashboard.posts",
                "order" => 4,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 26, 
                "icon" => "square", 
                "title" => 'dashboard.postset', 
                "route" => "dashboard.postset",
                "order" => 4,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 5, 
                "icon" => "", 
                "title" => 'dashboard.public_features', 
                "route" => "",
                "order" => 5,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 6, 
                "icon" => "file-text", 
                "title" => 'dashboard.blog', 
                "route" => "dashboard.blog",
                "order" => 6,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 15, 
                "icon" => "file-text", 
                "title" => 'dashboard.blog_category', 
                "route" => "dashboard.blog.category",
                "order" => 6,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 18, 
                "icon" => "thumbs-up", 
                "title" => 'dashboard.social_media', 
                "route" => "dashboard.social",
                "order" => 6,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 20, 
                "icon" => "link", 
                "title" => 'dashboard.webpage', 
                "route" => "dashboard.webpage",
                "order" => 6,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 22, 
                "icon" => "", 
                "title" => 'dashboard.manage_cards', 
                "route" => "",
                "order" => 14,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 23, 
                "icon" => "tablet", 
                "title" => 'dashboard.card', 
                "route" => "dashboard.card",
                "order" => 15,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 24, 
                "icon" => "sidebar", 
                "title" => 'dashboard.card_category', 
                "route" => "dashboard.card.category",
                "order" => 16,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 25, 
                "icon" => "check-square", 
                "title" => 'dashboard.card_order', 
                "route" => "dashboard.card.order",
                "order" => 17,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 7, 
                "icon" => "", 
                "title" => 'dashboard.dynamic_images', 
                "route" => "",
                "order" => 7,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 8, 
                "icon" => "image", 
                "title" => 'dashboard.image', 
                "route" => "dashboard.image",
                "order" => 8,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 9, 
                "icon" => "", 
                "title" => 'dashboard.setting_other', 
                "route" => "",
                "order" => 9,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 10, 
                "icon" => "bell", 
                "title" => 'dashboard.notification', 
                "route" => "dashboard.notification",
                "order" => 10,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 11, 
                "icon" => "mail", 
                "title" => 'dashboard.contact', 
                "route" => "dashboard.contact",
                "order" => 11,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 17, 
                "icon" => "globe", 
                "title" => 'dashboard.location', 
                "route" => "dashboard.location",
                "order" => 11,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 19, 
                "icon" => "file", 
                "title" => 'dashboard.pages', 
                "route" => "dashboard.pages",
                "order" => 11,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 21, 
                "icon" => "monitor", 
                "title" => 'dashboard.template', 
                "route" => "dashboard.template",
                "order" => 11,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 12, 
                "icon" => "user", 
                "title" => 'dashboard.profile', 
                "route" => "dashboard.profile",
                "order" => 1,
                "title_only" => "0",
                "type" => "3",
                "status" => "1"
            ],
            [
                "id" => 13, 
                "icon" => "", 
                "title" => 'dashboard.user_manage', 
                "route" => "",
                "order" => 12,
                "title_only" => "1",
                "type" => "2",
                "status" => "1"
            ],
            [
                "id" => 14, 
                "icon" => "user", 
                "title" => 'dashboard.user', 
                "route" => "dashboard.user",
                "order" => 13,
                "title_only" => "0",
                "type" => "2",
                "status" => "1"
            ],
        ];

        foreach (array_chunk($data,1000) as $t){
            Menu::insert($t); 
        }
    }
}
