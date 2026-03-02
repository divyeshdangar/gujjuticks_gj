<?php

namespace Database\Seeders;

use App\Models\UpdateCategory;
use Illuminate\Database\Seeder;

class UpdateCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'News', 'slug' => 'news'],
            ['name' => 'Festival', 'slug' => 'festival'],
            ['name' => 'Events', 'slug' => 'events'],
            ['name' => 'Opening / Launch', 'slug' => 'opening-launch'],
            ['name' => 'Lost & Found', 'slug' => 'lost-found'],
            ['name' => 'Lost Person', 'slug' => 'lost-person', 'is_important' => true],
            ['name' => 'Emergency / Alert', 'slug' => 'emergency-alert', 'is_important' => true],
            ['name' => 'Job / Hiring', 'slug' => 'job-hiring'],
            ['name' => 'Rental / Property', 'slug' => 'rental-property'],
            ['name' => 'Announcement', 'slug' => 'announcement'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'Offers / Deals', 'slug' => 'offers-deals'],
            ['name' => 'Community Help', 'slug' => 'community-help'],
            ['name' => 'Question', 'slug' => 'question'],
            ['name' => 'General', 'slug' => 'general'],
        ];

        foreach ($categories as $i => $category) {
            UpdateCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['name'] . ' updates',
                    'is_active' => true,
                    'is_important' => $category['is_important'] ?? false,
                    'sort_order' => $i + 1,
                ]
            );
        }
    }
}

