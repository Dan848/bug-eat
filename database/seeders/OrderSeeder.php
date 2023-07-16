<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayMonth = ["2022-08-", "2022-09-", "2022-10-", "2022-11-", "2022-12-", "2023-01-", "2023-02-", "2023-03-", "2023-04-", "2023-05-", "2023-06-", "2023-07-",];
        $restaurants = Restaurant::all();
        //Entra in Ristorante (Tonino, Daje Pizza, ecc.)
        foreach($restaurants as $restaurant){
            //Calcola indice massimo in base al menù (num dei prodotti)
            $productIndexMax = $restaurant->products->count() - 1;
            //Entra in Mese (Luglio Ristorante 1, Agosto, ecc.)
            for($i = 0; $i < 12; $i++){
                //Genera un Numero casuale di Ordini per quel mese
                $randomNumOrders = rand(10, 50);
                //Per ogni singolo ordine generiamo...
                for($j = 0; $j < $randomNumOrders; $j++){
                    //...l'orario e...
                    $randomTime = str_pad(rand(11, 23), 2, "0", STR_PAD_LEFT)  . ':'. str_pad(rand(0, 59), 2, "0", STR_PAD_LEFT) .  ':'. str_pad(rand(0, 59), 2, "0", STR_PAD_LEFT);
                    //...il giorno
                    $randomDay = $i == 11 ? str_pad(rand(1, 15), 2, "0", STR_PAD_LEFT) : str_pad(rand(1, 28), 2, "0", STR_PAD_LEFT);
                    //...1) per creare la data finale casuale
                    $date_time = $arrayMonth[$i] . $randomDay . ' ' . $randomTime;
                    //...2) l'array dei prodotti
                    $products=[];
                    //...3) il num di prodotti diversi che dovrà contenere
                    $differentProducts = rand(1, 5);
                    //...4) il total price che verrà calcolato man mano che inseriamo i prodotti
                    $total_price = 0;
                    //...inizializiamo k a 0 e cicliamo finchè non abbiamo k different products diversi
                    $k = 0;
                    while($k < $differentProducts){
                        $randomIndex = rand(0, $productIndexMax);
                        $product = $restaurant->products[$randomIndex];
                        if(!in_array($product, $products) && $product["visible"] == 1){
                            $product["quantity"] = rand(1, 3);
                            array_push($products, $product);
                            $total_price = $total_price + ($product["price"] * $product["quantity"]);
                            $k++;
                        };
                    }
                    //Nuovo ordine
                    $newOrder = new Order;
                    $newOrder->user_email = 'test@mail.it';
                    $newOrder->shipment_address = 'Via Bu Leana 101';
                    $newOrder->total_price = $total_price;
                    $newOrder->date_time = $date_time;
                    $newOrder->save();
                    //Array dell'order per seeddare la tabella ponte
                    $order = [
                        'user_email' => 'test@mail.it',
                        'shipment_address' => 'Via Bu Leana 101',
                        'total_price' => $total_price,
                        'date_time' => '2022-07-01 10:17:41',
                        'products' => $products,
                    ];

                    $collection = collect($order["products"])->mapWithKeys(function ($product) {
                        return [$product['id'] => ['quantity' => $product['quantity']]];
                    });
                    $newOrder->products()->sync($collection);
                }
            }

        }
    }
}
