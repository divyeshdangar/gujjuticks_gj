<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Days;
use Illuminate\Support\Facades\Schema;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Days::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'January',
                'year' => '',
                'title' => 'World Braille Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'January',
                'year' => '',
                'title' => 'International Day of Education',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'January',
                'year' => '',
                'title' => 'International Day of Clean Energy',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'January',
                'year' => '',
                'title' => 'International Day of Commemoration in Memory of the Victims of the Holocaust',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'February',
                'year' => '',
                'title' => 'World Wetlands Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'February',
                'year' => '',
                'title' => 'World Cancer Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'February',
                'year' => '',
                'title' => 'International Day of Human Fraternity',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '6',
                'month' => 'February',
                'year' => '',
                'title' => 'International Day of Zero Tolerance to Female Genital Mutilation',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'February',
                'year' => '',
                'title' => 'World Pulses Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'February',
                'year' => '',
                'title' => 'International Day of Women and Girls in Science',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'February',
                'year' => '',
                'title' => 'World Radio Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'February',
                'year' => '',
                'title' => 'World Day of Social Justice',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'February',
                'year' => '',
                'title' => 'United Nations International Mother Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'March',
                'year' => '',
                'title' => 'World Seagrass Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'March',
                'year' => '',
                'title' => 'United Nations Zero Discrimination Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '3',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day for Ear and Hearing Loss',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '3',
                'month' => 'March',
                'year' => '',
                'title' => 'World Wildlife Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day for Disarmament and Non-Proliferation Awareness',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'March',
                'year' => '',
                'title' => 'International Women\'s Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Women Judges',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Action for Rivers',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day to combat Islamophobia',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Happiness',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'March',
                'year' => '',
                'title' => 'French Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day for the Elimination of Racial Discrimination',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'World Poetry Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'International Nowruz Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'World Down Syndrome Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Forests',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'March',
                'year' => '',
                'title' => 'World Water Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'March',
                'year' => '',
                'title' => 'World Meteorological Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'March',
                'year' => '',
                'title' => 'World Tuberculosis Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day for the Right to the Truth concerning Gross Human Rights',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Remembrance of the Victims of Slavery',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Solidarity with Detained and Missing Staff Members',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'March',
                'year' => '',
                'title' => 'International Day of Zero Waste',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'April',
                'year' => '',
                'title' => 'World Autism Awareness Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day for Mine Awareness and Assistance in Mine Action',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day of Conscience',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '6',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day of Sport for Development and Peace',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'April',
                'year' => '',
                'title' => 'World Health Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day of Reflection on the Genocide in Rwanda',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day of Human Space Flight',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'April',
                'year' => '',
                'title' => 'World Chagas Disease Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'April',
                'year' => '',
                'title' => 'World Art Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'April',
                'year' => '',
                'title' => 'Chinese Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'April',
                'year' => '',
                'title' => 'World Creativity and Innovation Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'April',
                'year' => '',
                'title' => 'International Mother Earth Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'April',
                'year' => '',
                'title' => 'World Book and Copyright Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'April',
                'year' => '',
                'title' => 'Spanish Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'April',
                'year' => '',
                'title' => 'English Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'April',
                'year' => '',
                'title' => 'International Day of Multilateralism and Diplomacy for Peace',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'April',
                'year' => '',
                'title' => 'International Delegates Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'April',
                'year' => '',
                'title' => 'World Malaria Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'April',
                'year' => '',
                'title' => 'International Girls in ICT Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'April',
                'year' => '',
                'title' => 'Word Intellectual Property Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'April',
                'year' => '',
                'title' => 'International Chernobyl Disaster Remembrance Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'April',
                'year' => '',
                'title' => 'International Girls in ICT Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'April',
                'year' => '',
                'title' => 'World Day for Safety and Health at Work',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'April',
                'year' => '',
                'title' => 'International Dance Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'April',
                'year' => '',
                'title' => 'International Jazz Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'May',
                'year' => '',
                'title' => 'International Labour Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'May',
                'year' => '',
                'title' => 'World Tuna Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'May',
                'year' => '',
                'title' => 'International Astronomy Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '3',
                'month' => 'May',
                'year' => '',
                'title' => 'World Press Freedom Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'May',
                'year' => '',
                'title' => 'Time of Remembrance for those Who Lost Their Lives during the WWII',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Argania',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'May',
                'year' => '',
                'title' => 'World Migratory Bird Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Plant Health',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'May',
                'year' => '',
                'title' => 'International Nurses Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Families',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Living Together in Peace',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Light',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'May',
                'year' => '',
                'title' => 'World Telecommunication and Information Society Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'May',
                'year' => '',
                'title' => 'International Museum Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'May',
                'year' => '',
                'title' => 'World Bee Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'May',
                'year' => '',
                'title' => 'World Day for Cultural Diversity for Dialogue and Development',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'May',
                'year' => '',
                'title' => 'International Tea Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day for Biological Diversity',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day to End Obstetric Fistula',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Vesak',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of the Markhor',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'May',
                'year' => '',
                'title' => 'Africa Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'May',
                'year' => '',
                'title' => 'World Football Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Action for Women\'s Health',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of United Nations Peacekeepers',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'May',
                'year' => '',
                'title' => 'International Mount Everest Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'May',
                'year' => '',
                'title' => 'International Day of Potato',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '31',
                'month' => 'May',
                'year' => '',
                'title' => 'World No-Tobacco Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'June',
                'year' => '',
                'title' => 'Global Day of Parents',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '3',
                'month' => 'June',
                'year' => '',
                'title' => 'World Bicycle Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of Innocent Children Victims of Aggression',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day against Illegal, Unreported &Unregulated fishing',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'June',
                'year' => '',
                'title' => 'World Environment Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '6',
                'month' => 'June',
                'year' => '',
                'title' => 'Russian Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'June',
                'year' => '',
                'title' => 'World Food Safety Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'June',
                'year' => '',
                'title' => 'World Oceans Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'June',
                'year' => '',
                'title' => 'World Day Against Child Labour',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'June',
                'year' => '',
                'title' => 'International Albinism Awareness Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'June',
                'year' => '',
                'title' => 'World Blood Donor Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'June',
                'year' => '',
                'title' => 'World Elder Abuse Awareness Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of Family Remittances',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'June',
                'year' => '',
                'title' => 'International Integration Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'June',
                'year' => '',
                'title' => 'World Day to Combat Desertification and Drought',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'June',
                'year' => '',
                'title' => 'Sustainable Gastronomy Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day for Countering Hate Speech',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day for the Elimination of Sexual Violence in Conflict',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'June',
                'year' => '',
                'title' => 'World Refugee Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of Yoga',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of the Celebration of the Solstice',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'June',
                'year' => '',
                'title' => 'United Nations Public Service Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'June',
                'year' => '',
                'title' => 'International Widows" Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'June',
                'year' => '',
                'title' => 'International Olympic Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of Women in Diplomacy',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of the Seafarer',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day against Drug Abuse and illicit Trafficking',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day in Support of Victims of Torture',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'June',
                'year' => '',
                'title' => 'Micro, Small and Medium-sized Enterprises Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of the Tropics',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'June',
                'year' => '',
                'title' => 'International Day of Parliamentarism',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'June',
                'year' => '',
                'title' => 'International Asteroid Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'July',
                'year' => '',
                'title' => 'World Population Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'July',
                'year' => '',
                'title' => 'International Day of Reflection and Commemoration of the 1995 Genocide in Srebrenica',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'July',
                'year' => '',
                'title' => 'International Day of combating Sand and Dust Stoms',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'July',
                'year' => '',
                'title' => 'World Youth Skills Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'July',
                'year' => '',
                'title' => 'International Criminal Justice Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'July',
                'year' => '',
                'title' => 'Nelson Mandela International Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'July',
                'year' => '',
                'title' => 'World Chess Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'July',
                'year' => '',
                'title' => 'International Tiger Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'July',
                'year' => '',
                'title' => 'World Hepatitis Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'July',
                'year' => '',
                'title' => 'World Day against Trafficking in Persons',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'July',
                'year' => '',
                'title' => 'International Day of Friendship',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day of the World\'s Indigenous Peoples',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'August',
                'year' => '',
                'title' => 'International Youth Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'August',
                'year' => '',
                'title' => 'World Humanitarian Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day of Remembrance and Tribute to the Victims of Terrorism',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'August',
                'year' => '',
                'title' => 'Int\'l Day Commemorating the Victims of Acts of Violence Based on Religion',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day for the Remembrance of the Slave Trade and its Abolition',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day against Nuclear Tests',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day of the Victims of Enforced Disappearances',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '31',
                'month' => 'August',
                'year' => '',
                'title' => 'International Day for People of African Descent',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Charity',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Clean Air for Blue Skies',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'September',
                'year' => '',
                'title' => 'International Literacy Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day to Protect Education from Attack',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'September',
                'year' => '',
                'title' => 'Suicide Prevention Awareness Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'September',
                'year' => '',
                'title' => 'United Nations Day for South-South Cooperation',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Democracy',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'September',
                'year' => '',
                'title' => 'National Engineer\'s Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Science, Technology, and Innovation for the South',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day for the Preservation of the Ozone Layer',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'September',
                'year' => '',
                'title' => 'World Patient Safety Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'September',
                'year' => '',
                'title' => 'International Equal Pay Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'September',
                'year' => '',
                'title' => 'World CleanUp Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of the Air Traffic Controller',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Peace',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Sign Language',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'September',
                'year' => '',
                'title' => 'World Rivers Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'September',
                'year' => '',
                'title' => 'World Maritime Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day for the Total Elimination of Nuclear Weapons',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'September',
                'year' => '',
                'title' => 'World Tourism Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day for Universal Access to Information',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'September',
                'year' => '',
                'title' => 'International Day of Awareness of Food Loss and Waste',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'September',
                'year' => '',
                'title' => 'International Translation Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day of Older Persons',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day of Non-Violence',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'October',
                'year' => '',
                'title' => 'World Teachers’ Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'October',
                'year' => '',
                'title' => 'World Habitat Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'October',
                'year' => '',
                'title' => 'World Post Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'October',
                'year' => '',
                'title' => 'World Mental Health Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day of the Girl Child',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day for Disaster Risk Reduction',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'October',
                'year' => '',
                'title' => 'World Migratory Bird Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'October',
                'year' => '',
                'title' => 'Global Handwashing Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day of Rural Women',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'October',
                'year' => '',
                'title' => 'World Food Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'October',
                'year' => '',
                'title' => 'International Day for the Eradication of Poverty',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'October',
                'year' => '',
                'title' => 'World Statistics Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'October',
                'year' => '',
                'title' => 'United Nations Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'October',
                'year' => '',
                'title' => 'World Development Information Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'October',
                'year' => '',
                'title' => 'World Day for Audiovisual Heritage',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '31',
                'month' => 'October',
                'year' => '',
                'title' => 'World Cities Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'November',
                'year' => '',
                'title' => 'International Day to End Impunity for Crimes against Journalists',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'November',
                'year' => '',
                'title' => 'World Tsunami Awareness Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '6',
                'month' => 'November',
                'year' => '',
                'title' => 'International Day for Preventing the Exploitation of the Environment in War',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'November',
                'year' => '',
                'title' => 'World Immunization Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'November',
                'year' => '',
                'title' => 'World Science Day for Peace and Development',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'November',
                'year' => '',
                'title' => 'World Diabetes Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'November',
                'year' => '',
                'title' => 'International Day for Tolerance',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'November',
                'year' => '',
                'title' => 'International Students Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'November',
                'year' => '',
                'title' => 'World Toilet Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'November',
                'year' => '',
                'title' => 'International Men\'s Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'November',
                'year' => '',
                'title' => 'World Day of Remembrance for Road Traffic Victims',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'November',
                'year' => '',
                'title' => 'Africa Industrialization Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'November',
                'year' => '',
                'title' => 'World Children\'s Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'November',
                'year' => '',
                'title' => 'World Philosophy Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'November',
                'year' => '',
                'title' => 'World Television Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'November',
                'year' => '',
                'title' => 'World Fisheries Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'November',
                'year' => '',
                'title' => 'International Day for the Elimination of Violence against Women',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'November',
                'year' => '',
                'title' => 'World Sustainable Transport Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'November',
                'year' => '',
                'title' => 'International Day of Solidarity with the Palestinian People',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'November',
                'year' => '',
                'title' => 'Day of Remembrance for all Victims of Chemical Warfare',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'December',
                'year' => '',
                'title' => 'World Aids Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day for the Abolition of Slavery',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '3',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day of Persons with Disabilities',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day of Banks',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'December',
                'year' => '',
                'title' => 'International Volunteer Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'December',
                'year' => '',
                'title' => 'World Soil Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'December',
                'year' => '',
                'title' => 'International Civil Aviation Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'December',
                'year' => '',
                'title' => 'International Anti-Corruption Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day of Commemoration and Dignity of the Victims of the Crime of Genocide',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'December',
                'year' => '',
                'title' => 'Human Rights Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'December',
                'year' => '',
                'title' => 'International Animal Rights Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'December',
                'year' => '',
                'title' => 'International Mountain Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'December',
                'year' => '',
                'title' => 'Universal Health Coverage Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day of Neutrality',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'December',
                'year' => '',
                'title' => 'International Migrants Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'December',
                'year' => '',
                'title' => 'Arabic Language Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'December',
                'year' => '',
                'title' => 'International Human Solidarity Day',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'December',
                'year' => '',
                'title' => 'International Day of Epidemic Preparadness',
                'description' => '',
                'extra' => 'United Nations International Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'January',
                'year' => '',
                'title' => 'Pravasi Bhartiya Diwas',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'January',
                'year' => '',
                'title' => 'World Hindi Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'January',
                'year' => '',
                'title' => 'National Human Trafficking Awareness Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'January',
                'year' => '',
                'title' => 'National Youth Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'January',
                'year' => '',
                'title' => 'Army Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'January',
                'year' => '',
                'title' => 'World Religion Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'January',
                'year' => '',
                'title' => 'National Girl child day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'January',
                'year' => '',
                'title' => 'Tourism Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '25',
                'month' => 'January',
                'year' => '',
                'title' => 'National Voters Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'January',
                'year' => '',
                'title' => 'Republic Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'January',
                'year' => '',
                'title' => 'Martyrs\' Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'January',
                'year' => '',
                'title' => 'World Neglected Tropical Diseases',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'February',
                'year' => '',
                'title' => 'Safer Internet Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'February',
                'year' => '',
                'title' => 'National De-Worming Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'February',
                'year' => '',
                'title' => 'National Women\'s Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'February',
                'year' => '',
                'title' => 'World Peace and Understanding Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'February',
                'year' => '',
                'title' => 'Central Excise Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'February',
                'year' => '',
                'title' => 'World NGO Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'February',
                'year' => '',
                'title' => 'National Science Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'March',
                'year' => '',
                'title' => 'World Civil Defence Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'March',
                'year' => '',
                'title' => 'World Day of the Fight Against Sexual Exploitation',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'March',
                'year' => '',
                'title' => 'National Security Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'March',
                'year' => '',
                'title' => 'World Kidney Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'March',
                'year' => '',
                'title' => 'World Consumer Rights Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'March',
                'year' => '',
                'title' => 'National Vaccination Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'March',
                'year' => '',
                'title' => 'Ordnance Factories Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'March',
                'year' => '',
                'title' => 'World Sparrow Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'March',
                'year' => '',
                'title' => 'World Forestry Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '27',
                'month' => 'March',
                'year' => '',
                'title' => 'World Theatre Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],



            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'April',
                'year' => '',
                'title' => 'National Maritime Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'April',
                'year' => '',
                'title' => 'World Homeopathy Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'April',
                'year' => '',
                'title' => 'National Pet Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'April',
                'year' => '',
                'title' => 'National Safe Motherhood Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'April',
                'year' => '',
                'title' => 'Cultural Unity Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'April',
                'year' => '',
                'title' => 'World Haemophilia Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'April',
                'year' => '',
                'title' => 'World Heritage Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'April',
                'year' => '',
                'title' => 'National Civil Services Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'April',
                'year' => '',
                'title' => 'National Administrative Professionals Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'April',
                'year' => '',
                'title' => 'Earth Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'April',
                'year' => '',
                'title' => 'National Panchayati Raj Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'April',
                'year' => '',
                'title' => 'Ayushman Bharat Diwas',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],



            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'May',
                'year' => '',
                'title' => 'World Asthma Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'May',
                'year' => '',
                'title' => 'World Athletics Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'May',
                'year' => '',
                'title' => 'World Red Cross & Red Crescent Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'May',
                'year' => '',
                'title' => 'World Thalassemia Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'May',
                'year' => '',
                'title' => 'World Mother Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'May',
                'year' => '',
                'title' => 'National Technology Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'May',
                'year' => '',
                'title' => 'Dengue Prevention Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '17',
                'month' => 'May',
                'year' => '',
                'title' => 'World Telecommunication Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'May',
                'year' => '',
                'title' => 'World Metrology Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'May',
                'year' => '',
                'title' => 'Anti-Terrorism Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'May',
                'year' => '',
                'title' => 'World Turtle Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'May',
                'year' => '',
                'title' => 'Commonwealth Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],



            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'June',
                'year' => '',
                'title' => 'World Milk Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'June',
                'year' => '',
                'title' => 'World Ocean Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'June',
                'year' => '',
                'title' => 'World Sickle Cell Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'June',
                'year' => '',
                'title' => 'World Music Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'June',
                'year' => '',
                'title' => 'National Statistics Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],



            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'July',
                'year' => '',
                'title' => 'National Doctor\'s Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'July',
                'year' => '',
                'title' => 'World UFO Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'July',
                'year' => '',
                'title' => 'World Sports Journalists Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'July',
                'year' => '',
                'title' => 'Mandela Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'July',
                'year' => '',
                'title' => 'Kargil Memorial Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'July',
                'year' => '',
                'title' => 'World Nature Conservation Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'July',
                'year' => '',
                'title' => 'World Nature Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '1',
                'month' => 'August',
                'year' => '',
                'title' => 'Clergy Sexual Abuse Awareness Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '6',
                'month' => 'August',
                'year' => '',
                'title' => 'Hiroshima Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'August',
                'year' => '',
                'title' => 'Nagasaki Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'August',
                'year' => '',
                'title' => 'World Tribal Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'August',
                'year' => '',
                'title' => 'World Biofuel Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'August',
                'year' => '',
                'title' => 'World Lion Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '15',
                'month' => 'August',
                'year' => '',
                'title' => 'India\'s Independence Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'August',
                'year' => '',
                'title' => 'World Mosquito Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'August',
                'year' => '',
                'title' => 'World Senior Citizen Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '29',
                'month' => 'August',
                'year' => '',
                'title' => 'National Sports Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'August',
                'year' => '',
                'title' => 'National Small Industry Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '2',
                'month' => 'September',
                'year' => '',
                'title' => 'World Coconut Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'September',
                'year' => '',
                'title' => 'Teachers Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'September',
                'year' => '',
                'title' => 'World First Aid Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'September',
                'year' => '',
                'title' => 'Hindi Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'September',
                'year' => '',
                'title' => 'World Alzheimer\'s Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '21',
                'month' => 'September',
                'year' => '',
                'title' => 'Biosphere Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'September',
                'year' => '',
                'title' => 'World Rhino Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'September',
                'year' => '',
                'title' => 'Right to Know Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'October',
                'year' => '',
                'title' => 'World Animal Welfare Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '5',
                'month' => 'October',
                'year' => '',
                'title' => 'World Teachers\' Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '8',
                'month' => 'October',
                'year' => '',
                'title' => 'Indian Air Force Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '10',
                'month' => 'October',
                'year' => '',
                'title' => 'National Post Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'October',
                'year' => '',
                'title' => 'World Day for Natural Disaster Reduction',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '24',
                'month' => 'October',
                'year' => '',
                'title' => 'World Polio Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '28',
                'month' => 'October',
                'year' => '',
                'title' => 'National Ayurveda Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '30',
                'month' => 'October',
                'year' => '',
                'title' => 'World Thrift Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '31',
                'month' => 'October',
                'year' => '',
                'title' => 'National Unity Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '9',
                'month' => 'November',
                'year' => '',
                'title' => 'World Legal Services Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '11',
                'month' => 'November',
                'year' => '',
                'title' => 'National Education Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '12',
                'month' => 'November',
                'year' => '',
                'title' => 'World Pneumonia Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '13',
                'month' => 'November',
                'year' => '',
                'title' => 'World Kindness Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'November',
                'year' => '',
                'title' => 'Children\'s Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '16',
                'month' => 'November',
                'year' => '',
                'title' => 'National Press Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '18',
                'month' => 'November',
                'year' => '',
                'title' => 'World Chronic Obstructive Pulmonary Disease Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '19',
                'month' => 'November',
                'year' => '',
                'title' => 'National Integration Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'November',
                'year' => '',
                'title' => 'Universal Children\'s Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '20',
                'month' => 'November',
                'year' => '',
                'title' => 'Transgender Day of Remembrance',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'November',
                'year' => '',
                'title' => 'National Law Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'November',
                'year' => '',
                'title' => 'Constitution Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '26',
                'month' => 'November',
                'year' => '',
                'title' => 'National Milk Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '4',
                'month' => 'December',
                'year' => '',
                'title' => 'Indian Navy Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '7',
                'month' => 'December',
                'year' => '',
                'title' => 'Indian Armed Force Flag Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '14',
                'month' => 'December',
                'year' => '',
                'title' => 'National Energy Conservation Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '22',
                'month' => 'December',
                'year' => '',
                'title' => 'National Mathematics Day',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
            [
                'type' => 'fix',
                'slug' => '',
                'day' => '23',
                'month' => 'December',
                'year' => '',
                'title' => 'Farmers Day (India)',
                'description' => '',
                'extra' => 'National/Internation Days'
            ],
        ];

        foreach (array_chunk($data, 1) as $t) {
            Days::insert($t);
        }
    }
}
