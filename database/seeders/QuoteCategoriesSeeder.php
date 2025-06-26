<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class QuoteCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Inspirational & Motivational' => [
                'Motivation',
                'Inspiration',
                'Success',
                'Determination',
                'Hard Work',
                'Dreams',
                'Goals',
                'Discipline',
                'Self-Improvement',
                'Never Give Up',
            ],
            'Self & Personal Development' => [
                'Self-Love',
                'Confidence',
                'Self-Care',
                'Inner Peace',
                'Mindfulness',
                'Mental Health',
                'Self-Respect',
                'Emotional Intelligence',
                'Self-Discovery',
                'Healing',
            ],
            'Wisdom & Life Lessons' => [
                'Life',
                'Wisdom',
                'Truth',
                'Experience',
                'Philosophy',
                'Perspective',
                'Change',
                'Simplicity',
                'Gratitude',
                'Patience',
            ],
            'Love & Relationships' => [
                'Love',
                'Friendship',
                'Family',
                'Romance',
                'Heartbreak',
                'Marriage',
                'Relationship Goals',
                'Trust',
                'Forgiveness',
                'Long Distance',
            ],
            'Education & Learning' => [
                'Learning',
                'Knowledge',
                'Study',
                'Reading',
                'Teaching',
                'Curiosity',
                'Intelligence',
            ],
            'Work & Success' => [
                'Career',
                'Leadership',
                'Entrepreneurship',
                'Business',
                'Money',
                'Productivity',
                'Teamwork',
                'Innovation',
                'Risk & Reward',
            ],
            'Emotions & Feelings' => [
                'Happiness',
                'Sadness',
                'Anger',
                'Fear',
                'Hope',
                'Compassion',
                'Courage',
                'Jealousy',
                'Joy',
            ],
            'Society & Humanity' => [
                'Kindness',
                'Equality',
                'Justice',
                'Peace',
                'Freedom',
                'Environment',
                'Culture',
                'Humanity',
            ],
            'Spiritual & Religious' => [
                'Spirituality',
                'God',
                'Faith',
                'Prayer',
                'Universe',
                'Karma',
                'Zen',
                'Meditation',
            ],
            'Time & Existence' => [
                'Time',
                'Death',
                'Aging',
                'Present Moment',
                'Memories',
                'Destiny',
                'Legacy',
            ],
            'Occasions & Celebrations' => [
                'Birthday',
                'New Year',
                'Christmas',
                'Anniversary',
                'Farewell',
                'Wedding',
                'Graduation',
            ],
            'Travel & Adventure' => [
                'Travel',
                'Nature',
                'Exploration',
                'Freedom',
                'Wanderlust',
                'Mountains & Oceans',
            ],
            'Creativity & Passion' => [
                'Art',
                'Music',
                'Writing',
                'Poetry',
                'Creativity',
                'Passion',
                'Expression',
            ],
            'Children & Parenting' => [
                'Children',
                'Parenting',
                'Motherhood',
                'Fatherhood',
                'Childhood',
                'Teaching Kids',
            ],
            'Humor & Fun' => [
                'Funny',
                'Sarcastic',
                'Wit & Humor',
                'Irony',
                'Puns',
            ],
        ];

        foreach ($categories as $parentName => $children) {
            $parentId = DB::table('quote_categories')->insertGetId([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($children as $childName) {
                DB::table('quote_categories')->insert([
                    'name' => $childName,
                    'slug' => null, //Str::slug($childName),
                    'parent_id' => $parentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
