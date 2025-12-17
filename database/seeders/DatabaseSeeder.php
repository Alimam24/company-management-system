<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\retail_store;
use App\Models\warehouse;
use App\Models\User;
use App\Models\product;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Call your existing seeders
        $this->call([
            EmpStateSeeder::class,
            EmpRoleSeeder::class,
            CustomerTypeSeeder::class,
            CustomerStateSeeder::class,
            DepartmentSeeder::class,
            CitiesSeeder::class,
        ]);

          // Seed persons
        person::factory()->count(20)->create();

        // Seed employees
        //employee::factory()->count(10)->create();

        // Seed customers
        customer::factory()->count(10)->create();

        // Seed users
        //user::factory()->count(10)->create();

        // Seed stores
        retail_store::factory()->count(20)->create();

        // Seed warehouses
        warehouse::factory()->count(20)->create();

        //seed products
        product::factory()->count(20)->create();
    
    }
}
