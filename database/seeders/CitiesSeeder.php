<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Cities = [
            ['Name' => 'Damascus'],
            ['Name' => 'Homes'], 
            ['Name' => 'Aleppo'], 
            ['Name' => 'Daraa'], 
            ['Name' => 'Latakia'], 
            ['Name' => 'Tartus'], 
            ['Name' => 'Idlib'], 
            ['Name' => 'Dair Alzour'],    
        ];

        DB::table('cities')->insert($Cities);
    }
}
