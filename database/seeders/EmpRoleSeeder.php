<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['RoleName' => 'employee'],
            ['RoleName' => 'manager'],
            ['RoleName' => 'marketer'],
        ];

        DB::table('emp_roles')->insert($roles);
    }
}
