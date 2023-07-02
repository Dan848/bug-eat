<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = config('dataseeder.orders');
            foreach($orders as $order)
            {
                $newOrder = new Order();
                $newOrder->user_email = $order['user_email'];
                $newOrder->shipment_address = $order['shipment_address'];
                $newOrder->total_price = $order['total_price'];
                $newOrder->date_time = $order['date_time'];

                $newOrder->save();
            };
    }
}
