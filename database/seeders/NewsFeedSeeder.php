<?php

namespace Database\Seeders;

use App\Models\NewsFeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class NewsFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        NewsFeed::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3220145172933337495", 
                "news_category_id" => "2",
                "title" => "Gujarat politics", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3382747739271904191", 
                "news_category_id" => "3",
                "title" => "Indian politics", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/2294385589532786213", 
                "news_category_id" => "4",
                "title" => "election Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3382747739271902125", 
                "news_category_id" => "6",
                "title" => "Gujarat crime", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/16520688744606293884", 
                "news_category_id" => "7",
                "title" => "Gujarat police", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3382747739271904391", 
                "news_category_id" => "8",
                "title" => "court cases in Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/9746367602827336880", 
                "news_category_id" => "10",
                "title" => "Gujarat business", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/16520688744606291287", 
                "news_category_id" => "11",
                "title" => "Indian startups", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7592468596306432564", 
                "news_category_id" => "12",
                "title" => "Ahmedabad economy", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/6090627722131813523", 
                "news_category_id" => "14",
                "title" => "India technology", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/16520688744606291738", 
                "news_category_id" => "15",
                "title" => "Gujarat IT news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7592468596306433056", 
                "news_category_id" => "16",
                "title" => "tech in Ahmedabad", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/6090627722131814668", 
                "news_category_id" => "18",
                "title" => "Gujarat education", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12177488156706551526", 
                "news_category_id" => "19",
                "title" => "schools in Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12177488156706551046", 
                "news_category_id" => "20",
                "title" => "universities", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/15392359373789001173", 
                "news_category_id" => "22",
                "title" => "Gujarat hospitals", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/15232276229879423285", 
                "news_category_id" => "23",
                "title" => "India health news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12177488156706553498", 
                "news_category_id" => "24",
                "title" => "AIIMS Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/15392359373789003584", 
                "news_category_id" => "26",
                "title" => "Gujarat cricket", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/15232276229879425886", 
                "news_category_id" => "27",
                "title" => "sports India", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/5762113653639473891", 
                "news_category_id" => "28",
                "title" => "IPL Gujarat Titans", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/15392359373789001646", 
                "news_category_id" => "30",
                "title" => "Bollywood", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12983235630369509080", 
                "news_category_id" => "31",
                "title" => "Gujarati movies", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12983235630369508905", 
                "news_category_id" => "32",
                "title" => "india cinemas", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/12619533769614009507", 
                "news_category_id" => "33",
                "title" => "OTT India", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/5017999099723199057", 
                "news_category_id" => "35",
                "title" => "Gujarati festivals", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/18143793176250333162", 
                "news_category_id" => "36",
                "title" => "Gujarat cultural events", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/18143793176250333715", 
                "news_category_id" => "37",
                "title" => "Navratri", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/5266371137135140175", 
                "news_category_id" => "39",
                "title" => "Places to visit in Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/18143793176250334405", 
                "news_category_id" => "40",
                "title" => "Gujarat tourism news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3828045092538455050", 
                "news_category_id" => "42",
                "title" => "Gujarat monsoon", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/5266371137135137775", 
                "news_category_id" => "43",
                "title" => "cyclone Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/1372246875938135707", 
                "news_category_id" => "44",
                "title" => "weather India", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/4820145690853798936", 
                "news_category_id" => "46",
                "title" => "Gujarat development", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/3828045092538454344", 
                "news_category_id" => "47",
                "title" => "new roads in Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/10562406809144219418", 
                "news_category_id" => "48",
                "title" => "metro news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/1372246875938135034", 
                "news_category_id" => "50",
                "title" => "Pollution Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/8885044725898611805", 
                "news_category_id" => "51",
                "title" => "green energy Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/8885044725898610943", 
                "news_category_id" => "52",
                "title" => "wildlife news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7919260611010135158", 
                "news_category_id" => "54",
                "title" => "Property news Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/8885044725898609219", 
                "news_category_id" => "55",
                "title" => "Ahmedabad real estate", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/13651691256936369871", 
                "news_category_id" => "57",
                "title" => "farmer protest Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7919260611010137234", 
                "news_category_id" => "58",
                "title" => "reservation Gujarat", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/13651691256936367619", 
                "news_category_id" => "59",
                "title" => "caste", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7919260611010134634", 
                "news_category_id" => "61",
                "title" => "ISRO", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/7919260611010137518", 
                "news_category_id" => "62",
                "title" => "Indian science news", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/13651691256936368185", 
                "news_category_id" => "63",
                "title" => "space missions India", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/538617987420462966", 
                "news_category_id" => "65",
                "title" => "PM Modi Yojana", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/6630029824792143772", 
                "news_category_id" => "66",
                "title" => "Gujarat government schemes", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/361540487824087810", 
                "news_category_id" => "68",
                "title" => "India foreign policy", 
            ],
            [
                "url" => "https://www.google.com/alerts/feeds/10574946886415694362/538617987420462081", 
                "news_category_id" => "69",
                "title" => "India global news", 
            ]
        ];

        foreach (array_chunk($data,10) as $t){
            NewsFeed::insert($t); 
        }
    }
}
