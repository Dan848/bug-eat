<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('dataseeder.restaurants');
        $rest_id = 1;
        foreach ($restaurants as $restaurant){
            $randomindex = random_int(0, count($restaurant['types']) - 1);
            $menu = $restaurant['types'][$randomindex];
            $row = 0;
            if (($handle = fopen(public_path("seed_csv/products/$menu.csv"), 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if ($row > 0){
                        $newProduct = new Product;
                        $newProduct->name = $data[0];
                        $newProduct->slug = Str::slug($newProduct->name, '-');
                        $newProduct->price = floatval($data[1]);
                        $newProduct->description = isset($data[2]) && $data[2] ? $data[2] : null;
                        $newProduct->restaurant_id = $rest_id;
                        $newProduct->visible = $newProduct->price ? true : false;
                        $newProduct->save();
                        $newProduct->slug = Str::slug($newProduct->name, '-') . "-" . $newProduct->id;
                        $newProduct->save();
                    }
                    $row++;
                }
                fclose($handle);
            }
            $rest_id++;
        };
    }
}
