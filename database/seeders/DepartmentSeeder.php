<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['DeptName' => 'Headquarters'], 
            ['DeptName' => 'Human resources'],  
            ['DeptName' => 'Marketing & customer contact'],  
            ['DeptName' => 'Retail Store Management'],  
            ['DeptName' => 'Warehouse Management'],  
            ['DeptName' => 'Product Management'],
        ];

        DB::table('departments')->insert($roles);
    }
}
