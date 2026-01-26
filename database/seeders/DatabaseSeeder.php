<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\employee;
use App\Models\Person;
use App\Models\product;
use App\Models\retail_store;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmpStateSeeder::class,
            EmpRoleSeeder::class,
            CustomerTypeSeeder::class,
            CustomerStateSeeder::class,
            DepartmentSeeder::class,
            CitiesSeeder::class,
            PersonSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            Retail_storeSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,

        ]);

        // // Seed persons
        // //Person::factory()->count(20)->create();

       

        // // Seed customers
        // customer::factory()->count(10)->create();

        // // Seed users
        // // user::factory()->count(10)->create();

        // // Seed stores
        // retail_store::factory()->count(20)->create();

        // // Seed warehouses
        // warehouse::factory()->count(20)->create();

        // // seed products
        // product::factory()->count(20)->create();

    }
}
