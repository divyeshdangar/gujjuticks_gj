<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Politics' => [
                'Gujarat politics',
                'Indian politics',
                'election Gujarat',
            ],
            'Crime & Law' => [
                'Gujarat crime',
                'Gujarat police',
                'court cases in Gujarat',
            ],
            'Business' => [
                'Gujarat business',
                'Indian startups',
                'Ahmedabad economy',
            ],
            'Technology' => [
                'India technology',
                'Gujarat IT news',
                'tech in Ahmedabad',
            ],
            'Education' => [
                'Gujarat education',
                'schools in Gujarat',
                'universities',
            ],
            'Health' => [
                'Gujarat hospitals',
                'India health news',
                'AIIMS Gujarat',
            ],
            'Sports' => [
                'Gujarat cricket',
                'sports India',
                'IPL Gujarat Titans',
            ],
            'Entertainment' => [
                'Bollywood',
                'Gujarati movies',
                'Indian cinemas',
                'OTT India',
            ],
            'Culture' => [
                'Gujarati festivals',
                'Gujarat cultural events',
                'Navratri',
            ],
            'Travel & Tourism' => [
                'Places to visit in Gujarat',
                'Gujarat tourism news',
            ],
            'Weather & Climate' => [
                'Gujarat monsoon',
                'cyclone Gujarat',
                'weather India',
            ],
            'Infrastructure' => [
                'Gujarat development',
                'new roads in Gujarat',
                'metro news',
            ],
            'Environment' => [
                'Pollution Gujarat',
                'green energy Gujarat',
                'wildlife news',
            ],
            'Real Estate' => [
                'Property news Gujarat',
                'Ahmedabad real estate',
            ],
            'Social Issues' => [
                'farmer protest Gujarat',
                'reservation Gujarat',
                'caste',
            ],
            'Science' => [
                'ISRO',
                'Indian science news',
                'space missions India',
            ],
            'Government Schemes' => [
                'PM Modi Yojana',
                'Gujarat government schemes',
            ],
            'International News' => [
                'India foreign policy',
                'India global news',
            ],
        ];

        foreach ($data as $parentName => $children) {
            $parent = NewsCategory::firstOrCreate([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'parent_id' => null,
            ]);

            foreach ($children as $childName) {
                NewsCategory::firstOrCreate([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
