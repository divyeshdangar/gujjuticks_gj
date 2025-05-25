<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Str;


class GujaratCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['id' => '1', 'image' => 'default.png', 'title' => 'Explore Ahmedabad: Gujarat\'s Largest and Most Vibrant City', 'description' => 'Discover Ahmedabad, the heart of Gujarat, known for its rich heritage, thriving businesses, and modern lifestyle. Find top local services and businesses in Ahmedabad now.', 'name' => 'Ahmedabad', 'latitude' => 23.0225, 'longitude' => 72.5714],
            ['id' => '2', 'image' => 'default.png', 'title' => 'Surat - The Diamond City of India and Textile Hub', 'description' => 'Explore Surat, Gujarat’s bustling city known for its diamond polishing and textile industries. Browse local businesses, food spots, and services across Surat.', 'name' => 'Surat', 'latitude' => 21.1702, 'longitude' => 72.8311],
            ['id' => '3', 'image' => 'default.png', 'title' => 'Vadodara - A Cultural and Industrial Powerhouse in Gujarat', 'description' => 'Known for the majestic Lakshmi Vilas Palace and a strong industrial base, Vadodara offers rich cultural experiences. Discover services, shops, and businesses in Vadodara.', 'name' => 'Vadodara', 'latitude' => 22.3072, 'longitude' => 73.1812],
            ['id' => '4', 'image' => 'default.png', 'title' => 'Rajkot - Hub of Saurashtra with Growing Business Opportunities', 'description' => 'Rajkot blends tradition and growth, making it a key player in Saurashtra. Find local businesses, services, and places in Rajkot for your needs.', 'name' => 'Rajkot', 'latitude' => 22.3039, 'longitude' => 70.8022],
            ['id' => '5', 'image' => 'default.png', 'title' => 'Bhavnagar - A Coastal City Rich in History and Industry', 'description' => 'From ship breaking yards to temples and trade, Bhavnagar is a city of contrasts. Explore businesses, local shops, and services in Bhavnagar.', 'name' => 'Bhavnagar', 'latitude' => 21.7645, 'longitude' => 72.1519],
            ['id' => '6', 'image' => 'default.png', 'title' => 'Jamnagar - Home of World’s Largest Oil Refinery and Culture', 'description' => 'Jamnagar, known for its Reliance oil refinery and old city charm, is a unique mix of tradition and modernity. Browse businesses and services in Jamnagar.', 'name' => 'Jamnagar', 'latitude' => 22.4707, 'longitude' => 70.0577],
            ['id' => '7', 'image' => 'default.png', 'title' => 'Gandhinagar - Gujarat’s Planned Capital City with Green Avenues', 'description' => 'Explore Gandhinagar, the green and organized capital of Gujarat. From IT parks to tourist spots, discover businesses and services in Gandhinagar.', 'name' => 'Gandhinagar', 'latitude' => 23.2156, 'longitude' => 72.6369],
            ['id' => '8', 'image' => 'default.png', 'title' => 'Junagadh - The Ancient City at the Foot of Girnar Hills', 'description' => 'With a legacy of empires and sacred peaks, Junagadh is full of history and culture. Find top local services and businesses in Junagadh.', 'name' => 'Junagadh', 'latitude' => 21.5222, 'longitude' => 70.4579],
            ['id' => '9', 'image' => 'default.png', 'title' => 'Anand - Birthplace of the White Revolution in India', 'description' => 'Anand, the home of Amul, revolutionized India’s dairy industry. Explore the top businesses and services available in Anand, Gujarat.', 'name' => 'Anand', 'latitude' => 22.5645, 'longitude' => 72.9289],
            ['id' => '10', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Navsari', 'latitude' => 20.9467, 'longitude' => 72.9520],
            ['id' => '11', 'image' => 'default.png', 'title' => 'Bharuch Local Directory - Gateway to Gujarat\'s Industrial Growth', 'description' => 'Find trusted businesses in Bharuch, one of the oldest cities of India and a modern-day industrial and trade center along the Narmada River.', 'name' => 'Bharuch', 'latitude' => 21.7051, 'longitude' => 72.9959],
            ['id' => '12', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Vapi', 'latitude' => 20.3717, 'longitude' => 72.9043],
            ['id' => '13', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Gandhidham', 'latitude' => 23.0758, 'longitude' => 70.1337],
            ['id' => '14', 'image' => 'default.png', 'title' => 'Mehsana - Dairy Capital and Thriving Industrial Zone of North Gujarat', 'description' => 'Mehsana is famed for its dairy sector and emerging industries. Discover businesses and local services that power this city in North Gujarat.', 'name' => 'Mehsana', 'latitude' => 23.5879, 'longitude' => 72.3693],
            ['id' => '15', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Porbandar', 'latitude' => 21.6417, 'longitude' => 69.6293],
            ['id' => '16', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Palanpur', 'latitude' => 24.1710, 'longitude' => 72.4397],
            ['id' => '17', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Valsad', 'latitude' => 20.5992, 'longitude' => 72.9344],
            ['id' => '18', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Botad', 'latitude' => 22.1704, 'longitude' => 71.6663],
            ['id' => '19', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Morbi', 'latitude' => 22.8173, 'longitude' => 70.8370],
            ['id' => '20', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Surendranagar', 'latitude' => 22.7196, 'longitude' => 71.6380],
            ['id' => '21', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Amreli', 'latitude' => 21.6032, 'longitude' => 71.2221],
            ['id' => '22', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Dahod', 'latitude' => 22.8357, 'longitude' => 74.2555],
            ['id' => '23', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Godhra', 'latitude' => 22.7755, 'longitude' => 73.6143],
            ['id' => '24', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Veraval', 'latitude' => 20.9120, 'longitude' => 70.3679],
            ['id' => '25', 'image' => 'default.png', 'title' => 'Explore Nadiad - The Cultural Heart of Kheda District', 'description' => 'Discover businesses, services, and local gems in Nadiad, a city known for its rich history, educational institutions, and spiritual heritage in Gujarat.', 'name' => 'Nadiad', 'latitude' => 22.6913, 'longitude' => 72.8634],
            ['id' => '26', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Bhuj', 'latitude' => 23.2530, 'longitude' => 69.6639],
            ['id' => '27', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Patan', 'latitude' => 23.8493, 'longitude' => 72.1256],
            ['id' => '28', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Modasa', 'latitude' => 23.4625, 'longitude' => 73.2985],
            ['id' => '29', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Chhota Udaipur', 'latitude' => 22.3031, 'longitude' => 74.0060],
            ['id' => '30', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Kheda', 'latitude' => 22.7500, 'longitude' => 72.6833],
            ['id' => '31', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Kalol', 'latitude' => 22.6078, 'longitude' => 73.4629],
            ['id' => '32', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Kapadvanj', 'latitude' => 23.0228, 'longitude' => 73.0706],
            ['id' => '33', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Sanand', 'latitude' => 22.9936, 'longitude' => 72.3818],
            ['id' => '34', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Deesa', 'latitude' => 24.2582, 'longitude' => 72.1906],
            ['id' => '35', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Dhoraji', 'latitude' => 21.7333, 'longitude' => 70.4500],
            ['id' => '36', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Jetpur', 'latitude' => 21.7456, 'longitude' => 70.6233],
            ['id' => '37', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Mangrol', 'latitude' => 21.1200, 'longitude' => 70.1167],
            ['id' => '38', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Khambhat', 'latitude' => 22.3174, 'longitude' => 72.6195],
            ['id' => '39', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Limbdi', 'latitude' => 22.5667, 'longitude' => 71.8000],
            ['id' => '40', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Dabhoi', 'latitude' => 22.1833, 'longitude' => 73.4167],
            ['id' => '41', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Mahesana', 'latitude' => 23.6000, 'longitude' => 72.4000],
            ['id' => '42', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Wadhwan', 'latitude' => 22.7000, 'longitude' => 71.6333],
            ['id' => '43', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Borsad', 'latitude' => 22.4076, 'longitude' => 72.8980],
            ['id' => '44', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Vyara', 'latitude' => 21.1167, 'longitude' => 73.4000],
            ['id' => '45', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Una', 'latitude' => 20.8167, 'longitude' => 71.0500],
            ['id' => '46', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Radhanpur', 'latitude' => 23.8333, 'longitude' => 71.6000],
            ['id' => '47', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Idar', 'latitude' => 23.8333, 'longitude' => 73.0000],
            ['id' => '48', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Visnagar', 'latitude' => 23.7000, 'longitude' => 72.5500],
            ['id' => '49', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Bhabhar', 'latitude' => 24.1833, 'longitude' => 71.5333],
            ['id' => '50', 'image' => 'default.png', 'title' => '', 'description' => '', 'name' => 'Halol', 'latitude' => 22.5000, 'longitude' => 73.4667],
        ];

        foreach ($cities as $city) {
            $city['state'] = 'Gujarat';
            $city['country'] = 'India';
            $city['slug'] = Str::slug($city['name']);
            City::updateOrCreate(['name' => $city['name']], $city);
        }
    }
}
