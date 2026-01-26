<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'id' => 1,
                'person_id' => 21,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 4,
                'person_id' => 24,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 6,
                'person_id' => 26,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 7,
                'person_id' => 27,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 8,
                'person_id' => 28,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 9,
                'person_id' => 29,
                'customer_type_id' => 2,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 2,
                'person_id' => 22,
                'customer_type_id' => 1,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 3,
                'person_id' => 23,
                'customer_type_id' => 1,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 5,
                'person_id' => 25,
                'customer_type_id' => 1,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
            [
                'id' => 10,
                'person_id' => 30,
                'customer_type_id' => 1,
                'customer_state_id' => 1,
                'created_at' => '2026-01-25 20:05:49',
                'updated_at' => '2026-01-25 20:05:49',
            ],
        ]);
    }
}
