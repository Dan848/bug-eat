<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('dataseeder.restaurants');
        foreach($restaurants as $restaurant)
        {
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->slug = Str::slug($newRestaurant->name, '-');
            $newRestaurant->email = $restaurant['email'];
            $newRestaurant->p_iva = $restaurant['p_iva'];
            $newRestaurant->phone_num = $restaurant['phone_num'];
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->type_1 = $restaurant['types'][0];
            $newRestaurant->type_2 = $restaurant['types'][1];
            $newRestaurant->user_id = $restaurant['user_id'];

            $newRestaurant->save();
        }
    }
}
