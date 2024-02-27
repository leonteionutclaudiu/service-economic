<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            // Generăm un preț întreg între 10 și 3000
            $price = $faker->numberBetween(10, 3000);

            // Setăm sale_price ca null în 50% din cazuri
            $salePrice = $faker->boolean(50) ? null : $faker->numberBetween(5, 50);

            // Generăm un titlu de lungime între 10 și 50 de caractere care conține doar litere și cifre
            $title = $faker->regexify('[A-Za-z0-9]{10,50}');

            $product = new Product([
                'published' => true,
                'title' => $title,
                'description' => $faker->paragraph(4),
                'price' => $price,
                'sale_price' => $salePrice,
                'in_stock' => $faker->boolean,
                'stock_quantity' => $faker->numberBetween(0, 100),
                'production_code' => $faker->unique()->ean13,
                'is_featured' => $faker->boolean(20),
            ]);

            $product->save();
        }
    }
}
