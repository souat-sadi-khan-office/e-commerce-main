<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['zone_id' => 1, 'name' => 'Algeria', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 1, 'name' => 'Angola', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 1, 'name' => 'Benin', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 1, 'name' => 'Botswana', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Bangladesh', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 1, 'name' => 'Burundi', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Canada', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Chile', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Colombia', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Costa Rica', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Cuba', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 2, 'name' => 'Dominican Republic', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Egypt', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Ethiopia', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Ghana', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Kenya', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Morocco', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'Nigeria', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 3, 'name' => 'South Africa', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 4, 'name' => 'Australia', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 4, 'name' => 'Fiji', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 4, 'name' => 'New Zealand', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 4, 'name' => 'Papua New Guinea', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 4, 'name' => 'Samoa', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 5, 'name' => 'Argentina', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 5, 'name' => 'Brazil', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 5, 'name' => 'Chile', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 5, 'name' => 'Peru', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 5, 'name' => 'Uruguay', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'China', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'India', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'Indonesia', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'Japan', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'Pakistan', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'Thailand', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 6, 'name' => 'Vietnam', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Austria', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Belgium', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Denmark', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Finland', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'France', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Germany', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Italy', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Netherlands', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Spain', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 7, 'name' => 'Sweden', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 8, 'name' => 'Iceland', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 8, 'name' => 'Norway', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 8, 'name' => 'Switzerland', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 8, 'name' => 'United Kingdom', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['zone_id' => 8, 'name' => 'United States', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('countries')->insert($countries);
    }
}
