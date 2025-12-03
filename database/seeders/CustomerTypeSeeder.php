<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['TypeName' => 'VIP'],   
            ['TypeName' => 'Normal'],   
        ];

        DB::table('customer_types')->insert($types);
    }
}
