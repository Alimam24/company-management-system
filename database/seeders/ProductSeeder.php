<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $now = Carbon::parse('2026-01-25 20:05:49');

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Wireless Office Headset',
                'description' => 'High-quality wireless headset designed for long office use and clear communication.',
                'price' => 517.44,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'USB-C Fast Charging Cable',
                'description' => 'Durable USB-C cable supporting fast charging and data transfer.',
                'price' => 38.59,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => '24-Inch Full HD Monitor',
                'description' => 'Slim-bezel Full HD monitor suitable for professional and home use.',
                'price' => 821.27,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Ergonomic Office Chair',
                'description' => 'Comfortable ergonomic chair designed to support long working hours.',
                'price' => 425.70,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Laser Multifunction Printer',
                'description' => 'All-in-one laser printer with scanning and copying capabilities.',
                'price' => 1109.49,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Network Security Router',
                'description' => 'Advanced router offering high-speed connectivity and enhanced security features.',
                'price' => 905.77,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'name' => 'High-Performance Laptop',
                'description' => 'Powerful laptop suitable for development, design, and multitasking workloads.',
                'price' => 1638.77,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'name' => 'Cloud Backup Storage Device',
                'description' => 'Reliable local backup solution with large storage capacity.',
                'price' => 1177.53,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'name' => 'Smart Inventory Scanner',
                'description' => 'Handheld barcode scanner optimized for inventory management systems.',
                'price' => 1562.49,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'name' => 'Point of Sale Terminal',
                'description' => 'Complete POS terminal designed for retail and store operations.',
                'price' => 1426.94,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with precise tracking and long battery life.',
                'price' => 79.35,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'name' => 'Mechanical Keyboard',
                'description' => 'Professional mechanical keyboard built for durability and accuracy.',
                'price' => 875.68,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 13,
                'name' => 'External SSD Drive 1TB',
                'description' => 'High-speed external SSD suitable for backups and data transport.',
                'price' => 645.84,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 14,
                'name' => 'Warehouse Label Printer',
                'description' => 'Thermal label printer optimized for warehouse and logistics operations.',
                'price' => 715.16,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 15,
                'name' => 'Surveillance IP Camera',
                'description' => 'High-resolution IP camera for indoor and outdoor surveillance.',
                'price' => 868.68,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 16,
                'name' => 'Enterprise Backup Server',
                'description' => 'Secure backup server designed for enterprise-level data protection.',
                'price' => 1658.33,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 17,
                'name' => 'Advanced Analytics Workstation',
                'description' => 'High-end workstation optimized for analytics and heavy computations.',
                'price' => 1905.08,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 18,
                'name' => 'Smart Access Control Device',
                'description' => 'Electronic access control device supporting cards and PIN authentication.',
                'price' => 811.01,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 19,
                'name' => 'Inventory Management Tablet',
                'description' => 'Rugged tablet designed for inventory and warehouse usage.',
                'price' => 983.50,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 20,
                'name' => 'Customer Self-Service Kiosk',
                'description' => 'Interactive kiosk allowing customers to browse and place orders independently.',
                'price' => 1111.37,
                'avatar_url' => '/products/default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
