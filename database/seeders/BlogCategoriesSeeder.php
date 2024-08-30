<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\BlogCategories;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        BlogCategories::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                "id" => 1, 
                "title" => "Finance and Investment", 
                "slug" => "finance-and-investment", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 2, 
                "title" => "Health and Wellness", 
                "slug" => "health-and-wellness", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 3, 
                "title" => "Technology and Gadgets", 
                "slug" => "technology-and-gadgets", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 4, 
                "title" => "Legal and Insurance", 
                "slug" => "legal-and-insurance", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 5, 
                "title" => "Real Estate", 
                "slug" => "real-estate", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 6, 
                "title" => "Education", 
                "slug" => "education", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 7, 
                "title" => "Business and Entrepreneurship", 
                "slug" => "business-and-entrepreneurship", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 8, 
                "title" => "Digital Marketing", 
                "slug" => "digital-marketing", 
                "image" => "default.png",
                "parent_id" => null,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 9, 
                "title" => "Personal Finance", 
                "slug" => "personal-finance", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 10, 
                "title" => "Corporate Finance", 
                "slug" => "corporate-finance", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 11, 
                "title" => "Public Finance", 
                "slug" => "public-finance", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 12, 
                "title" => "Behavioral Finance", 
                "slug" => "behavioral-finance", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 13, 
                "title" => "International Finance", 
                "slug" => "international-finance", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 14, 
                "title" => "Equity Investing", 
                "slug" => "equity-investing", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 15, 
                "title" => "Real Estate Investment", 
                "slug" => "real-estate-investment", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 16, 
                "title" => "Fixed Income", 
                "slug" => "fixed-income", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 17, 
                "title" => "Mutual Funds & ETFs", 
                "slug" => "mutual-funds-and-etfs", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 18, 
                "title" => "Alternative Investments", 
                "slug" => "alternative-investments", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 19, 
                "title" => "Retirement Planning", 
                "slug" => "retirement-planning", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 20, 
                "title" => "Socially Responsible Investing (SRI)", 
                "slug" => "socially-responsible-investing-sri", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "id" => 21, 
                "title" => "Portfolio Management", 
                "slug" => "portfolio-management", 
                "image" => "default.png",
                "parent_id" => 1,
                "description" => "",
                "meta_description" => "",
                "status" => "1",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        foreach (array_chunk($data,1000) as $t){
            BlogCategories::insert($t); 
        }
    }
}
