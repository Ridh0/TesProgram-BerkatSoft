<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'product_name' => "Produk 1",
                'selling_price' => "10000",
                'product_quantity' => "50",
            ]
        );
    }
}
