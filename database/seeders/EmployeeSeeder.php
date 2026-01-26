<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Raw SQL for employees
        DB::statement("
        INSERT INTO employees (
            assignable_type,
            assignable_id,
            emp_state_id,
            emp_role_id,
            created_at,
            updated_at,
            id,
            person_id,
            department_id
        ) VALUES
         (
            NULL,
            NULL,
            2,
            1,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            1,
            21,
            2
        ),
        (
            NULL,
            NULL,
            2,
            1,
            '2025-12-13 18:04:19',
            '2025-12-13 19:18:12',
            2,
            22,
            3
        ),
        (
            NULL,
            NULL,
            2,
            1,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            3,
            23,
            4
        ),
        (
            NULL,
            NULL,
            2,
            1,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            4,
            24,
            5
        ),
        (
            NULL,
            NULL,
            3,
            1,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            5,
            25,
            6
        ),
        (
            NULL,
            NULL,
            2,
            2,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            6,
            26,
            2
        ),
        (
            NULL,
            NULL,
            2,
            2,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            7,
            27,
            3
        ),
        (
            NULL,
            NULL,
            2,
            2,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            8,
            28,
            4
        ),
        (
            NULL,
            NULL,
            1,
            2,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            9,
            29,
            5
        ),
        (
            NULL,
            NULL,
            2,
            2,
            '2025-12-13 18:04:19',
            '2025-12-13 18:04:19',
            10,
            30,
            6
        );");
    }
}
