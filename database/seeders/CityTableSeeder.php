<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['country_id' => 1, 'name' => 'Algiers', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 2, 'name' => 'Luanda', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 3, 'name' => 'Cotonou', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 4, 'name' => 'Gaborone', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 5, 'name' => 'Dhaka', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 6, 'name' => 'Gitega', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 7, 'name' => 'Ottawa', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 8, 'name' => 'Santiago', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 9, 'name' => 'Bogotá', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 10, 'name' => 'San José', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 11, 'name' => 'Havana', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 12, 'name' => 'Santo Domingo', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 13, 'name' => 'Cairo', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 14, 'name' => 'Addis Ababa', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 15, 'name' => 'Accra', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 16, 'name' => 'Nairobi', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 17, 'name' => 'Rabat', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 18, 'name' => 'Abuja', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 19, 'name' => 'Pretoria', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 20, 'name' => 'Canberra', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 21, 'name' => 'Suva', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 22, 'name' => 'Wellington', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 23, 'name' => 'Port Moresby', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 24, 'name' => 'Apia', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 25, 'name' => 'Buenos Aires', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 26, 'name' => 'Brasília', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 27, 'name' => 'Santiago', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 28, 'name' => 'Lima', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 29, 'name' => 'Montevideo', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 30, 'name' => 'Beijing', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 31, 'name' => 'New Delhi', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 32, 'name' => 'Jakarta', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 33, 'name' => 'Tokyo', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 34, 'name' => 'Islamabad', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 35, 'name' => 'Bangkok', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 36, 'name' => 'Hanoi', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 37, 'name' => 'Vienna', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 38, 'name' => 'Brussels', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 39, 'name' => 'Copenhagen', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 40, 'name' => 'Helsinki', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 41, 'name' => 'Paris', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 42, 'name' => 'Berlin', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 43, 'name' => 'Rome', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 44, 'name' => 'Amsterdam', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 45, 'name' => 'Madrid', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 46, 'name' => 'Stockholm', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 47, 'name' => 'Oslo', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 48, 'name' => 'Lisbon', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 49, 'name' => 'London', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 50, 'name' => 'Dublin', 'status' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('cities')->insert($cities);
    }
}
