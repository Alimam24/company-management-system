<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $states = [
            ['StateName' => 'Active Employee'],
            ['StateName' => 'Resigned / Terminated'],
            ['StateName' => 'Unpaid Leave'],
        ];

        DB::table('emp_states')->insert($states);
    }
}
