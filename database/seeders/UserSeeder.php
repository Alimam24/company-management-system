<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
        INSERT INTO users (
            password,
            id,
            employee_id,
            UserName,
            Is_Active,
            created_at,
            updated_at
        ) VALUES
        (
            '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
            1,
            1,
            'employee',
            '1',
            NULL,
            NULL
        ),
        (
            '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
            2,
            2,
            'customer',
            '1',
            NULL,
            NULL
        ),
        (
            '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
            3,
            3,
            'store',
            '1',
            NULL,
            NULL
        ),
        (
            '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
            4,
            4,
            'warehouse',
            '1',
            NULL,
            NULL
        ),
        (
            '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
            5,
            5,
            'product',
            '1',
            NULL,
            NULL
        ),
        (
        '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
        6,
        6,
        'Memployee',
        '1',
        NULL,
        NULL
        ),
        (
        '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
        7,
        7,
        'Mcustomer',
        '1',
        NULL,
        NULL
        ),
        (
        '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
        8,
        8,
        'Mstore',
        '1',
        NULL,
        NULL
        ),
        (
        '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
        9,
        9,
        'Mwarehouse',
        '1',
        NULL,
        NULL
        ),
        (
        '$2y$12$3QsWdh3Nm.Pns7MZlcNh/.Hw35s7xFQUNui1nLeV3Cd1.PLqOFBrq',
        10,
        10,
        'Mproduct',
        '1',
        NULL,
        NULL
        );");
    }
}
