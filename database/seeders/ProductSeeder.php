<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = config('dataseeder.products');
        foreach($products as $product)
        {
            $newProduct = new Product();
            $newProduct->name = $product['name'];
            $newProduct->slug = Str::slug($newProduct->name, '-');
            $newProduct->price = $product['price'];
            $newProduct->description = $product['description'];
            $newProduct->image = $product['image'];
            $newProduct->visible = $product['visible'];
            $newProduct->restaurant_id = $restaurant['restaurant_id'];

            $newProduct->save();
        }
    }
}
