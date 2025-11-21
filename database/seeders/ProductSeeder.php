<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
    Product::insert([
    [
        'name' => 'Caramel Latte',
        'slug' => 'caramel-latte',
        'description' => 'Minuman kopi dengan caramel.',
        'category_id' => 1,
        'price' => 25000,
        'stock' => 30,
    ],
    [
        'name' => 'Brown Sugar Milk',
        'slug' => 'brown-sugar-milk',
        'description' => 'Minuman susu gula aren.',
        'category_id' => 2,
        'price' => 20000,
        'stock' => 20,
    ],
]);
}
}