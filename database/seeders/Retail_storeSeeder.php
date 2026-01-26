<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Retail_storeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('retail_stores')->insert([
            [
                'id' => 1,
                'StoreName' => 'Purdy Central Market',
                'Address' => "63221 Pansy Mall\nNorth Bernardo, IN 10300-9434",
                'Phone' => '713.910.2213',
                'city_id' => 8,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 2,
                'StoreName' => 'Goldner City Superstore',
                'Address' => "677 Rubye Lane Apt. 356\nGoldnerchester, IN 78936",
                'Phone' => '+16314671509',
                'city_id' => 1,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 3,
                'StoreName' => 'Westline Retail Hub',
                'Address' => "452 Roberts Corners\nPort Kaylie, TX 43566",
                'Phone' => '1-321-983-1199',
                'city_id' => 1,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 4,
                'StoreName' => 'Ursula Town Mall',
                'Address' => "565 Yadira Road\nUrsulamouth, ID 09555-9562",
                'Phone' => '+1 (347) 429-4017',
                'city_id' => 3,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 5,
                'StoreName' => 'Elliottport Business Center',
                'Address' => "4804 Wilfrid Mission\nNorth Elliottport, KS 53166-1019",
                'Phone' => '+1 (781) 963-9826',
                'city_id' => 3,
                'manager_id' => null,
                'Brochure_url' => 'https://via.placeholder.com/640x480.png/00ee99?text=business+et',
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 6,
                'StoreName' => 'Goldnerside Plaza',
                'Address' => "8093 Jay Prairie Apt. 795\nGoldnerside, DC 04029",
                'Phone' => '1-830-695-8437',
                'city_id' => 6,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 7,
                'StoreName' => 'Howefort Retail Park',
                'Address' => "919 Floyd Flat\nHowefort, IL 53818",
                'Phone' => '704-363-4443',
                'city_id' => 7,
                'manager_id' => null,
                'Brochure_url' => 'https://via.placeholder.com/640x480.png/003399?text=business+quaerat',
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 8,
                'StoreName' => 'Giovanni Market Center',
                'Address' => "30483 Eliezer Green Suite 334\nGiovannimouth, MA 35493",
                'Phone' => '732.621.9616',
                'city_id' => 1,
                'manager_id' => null,
                'Brochure_url' => 'https://via.placeholder.com/640x480.png/001122?text=business+tempore',
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 9,
                'StoreName' => 'Rodriguez Commercial Store',
                'Address' => "5799 Holden Square Suite 046\nRodriguezmouth, GA 98927-2593",
                'Phone' => '479.432.0559',
                'city_id' => 1,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 10,
                'StoreName' => 'Christiansen Retail Group',
                'Address' => "555 Deckow Drive\nWest Vance, KS 67904",
                'Phone' => '1-347-564-8859',
                'city_id' => 2,
                'manager_id' => null,
                'Brochure_url' => 'https://via.placeholder.com/640x480.png/0099aa?text=business+reiciendis',
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],

            [
                'id' => 11,
                'StoreName' => 'Vandervort Retail Complex',
                'Address' => "8479 Hane Shoal Apt. 424\nVandervortport, NJ 92494-6065",
                'Phone' => '1-636-577-9273',
                'city_id' => 4,
                'manager_id' => null,
                'Brochure_url' => null,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
        ]);
    }
}
