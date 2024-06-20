<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'brand_id' => rand(1,5),
                'sku' => rand(1000,25000),
                'name' => 'Product 1'.rand(10,25),

                'description' => 'Description 1'.Str::random(250),
                'details' => 'details'.Str::random(565),

                'is_featured' => 1,
                'is_active'=>1,

                'views' => rand(20000,50000),
                'dimensions' => '25*36',

                'additional_info' => 'info'.Str::random(10)


                ],

            // ... add more products
        ];

        // Loop through the products array and insert them into the database
        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
