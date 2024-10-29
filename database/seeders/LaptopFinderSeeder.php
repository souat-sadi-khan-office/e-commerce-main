<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaptopFinderBudget;
use App\Models\LaptopFinderFeatures;
use App\Models\LaptopFinderPortability;
use App\Models\LaptopFinderPurpose;
use App\Models\LaptopFinderScreenSize;

class LaptopFinderSeeder extends Seeder
{
    public function run()
    {
        // LaptopFinderBudget data
        LaptopFinderBudget::create(
            [ 'name' => '40000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '50000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '60000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '80000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '100000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '1500000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '2000000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '2500000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '3000000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '4000000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '7000000', 'status' => 1, 'created_by' => 1],
            [ 'name' => '8000000', 'status' => 1, 'created_by' => 1]
        );

        // LaptopFinderPurpose data
        LaptopFinderPurpose::create(
            ['name' => 'Basic Home Use', 'details' => 'Everyday tasks like browsing and entertainment', 'status' => 1, 'created_by' => 1],
            ['name' => 'Basic Office Use', 'details' => 'Word processing, spreadsheets, communication', 'status' => 1, 'created_by' => 1],
            ['name' => 'Study', 'details' => 'For academic study, research, and online learning', 'status' => 1, 'created_by' => 1],
            ['name' => 'Freelancing', 'details' => 'For various freelance work', 'status' => 1, 'created_by' => 1],
            ['name' => 'Basic Programming', 'details' => 'Suitable for coding', 'status' => 1, 'created_by' => 1],
            ['name' => 'Software Development', 'details' => 'Complex software coding', 'status' => 1, 'created_by' => 1],
            ['name' => 'Graphic Design', 'details' => 'Digital art and design work', 'status' => 1, 'created_by' => 1],
            ['name' => 'Video Editing', 'details' => 'Video editing and rendering tasks', 'status' => 1, 'created_by' => 1],
            ['name' => 'Gaming', 'details' => 'High-end gaming experience', 'status' => 1, 'created_by' => 1],
            ['name' => 'Streaming', 'details' => 'For online video and live broadcasts', 'status' => 1, 'created_by' => 1],
            ['name' => 'Gaming & Streaming', 'details' => 'Simultaneous gaming and streaming', 'status' => 1, 'created_by' => 1]
        );

        // LaptopFinderScreenSize data
        LaptopFinderScreenSize::create(
            [ 'name' => 'Less than 13 inches', 'details' => 'Small and easy to carry', 'status' => 1, 'created_by' => 1], 
            [ 'name' => '13 to 14.9 inches', 'details' => 'Good for work and fun', 'status' => 1, 'created_by' => 1], 
            [ 'name' => '15 to 17 inches', 'details' => 'Great for work and movies at home', 'status' => 1, 'created_by' => 1], 
            [ 'name' => 'Bigger than 17 inches', 'details' => 'Best for gaming and serious work', 'status' => 1, 'created_by' => 1]
        );

        // LaptopFinderPortability data
        LaptopFinderPortability::create(
            [ 'name' => 'Yes', 'details' => 'I need it to be lightweight and compact', 'status' => 1, 'created_by' => 1],
            [ 'name' => 'Not necessary', 'details' => 'I\'ll use it mainly at home or in the office', 'status' => 1, 'created_by' => 1],
        );

        // LaptopFinderFeatures data
        LaptopFinderFeatures::create(
            [ 'name' => 'Touch Screen', 'details' => 'Supports touch inputs', 'status' => 1, 'created_by' => 1]
        );
    }
}