<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $faker = Faker::create();

          for ($i = 0; $i < 20; $i++) {
              $product = new Product([
                  'published' => true,
                  'title' => $faker->sentence,
                  'description' => $faker->paragraph,
                  'price' => $faker->randomFloat(2, 10, 100),
                  'sale_price' => $faker->randomFloat(2, 5, 50),
                  'in_stock' => $faker->boolean,
                  'stock_quantity' => $faker->numberBetween(0, 100),
                  'production_code' => $faker->ean8,
                  'is_featured' => $faker->boolean,
              ]);

              $product->save();
          }
      }
    }
