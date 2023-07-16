<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\NewOrder;
use App\Models\Order;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request){
        $data = $request->all();
        $newOrder = Order::create($data);
        $newOrder->save();

        $collection = collect($request->products)->mapWithKeys(function ($product) {
            return [$product['id'] => ['quantity' => $product['quantity']]];
        });
        $newOrder->products()->sync($collection); //Funziona

        $order=[
            'number' => $newOrder->id,
            'shipment_address'=> $request->shipment_address,
            'products' => $request->products,
            'total_price' => $newOrder->total_price,
        ];

        Mail::to($request->user_email)->send(new NewOrder($order)); //send Mail
        Mail::to($request->restaurant_email)->send(new NewOrder($order)); //send Mail

        return response()->json([ //success to stop axios
            'success' => true,
            "data" => $data,
        ]);
    }

    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            "token" => $token
        ];
        return response()->json($data,200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway){

        $data = $request->all();

        $result = $gateway->transaction()->sale([
            "amount" => $data["amount"],
            "paymentMethodNonce" => $request->token,
            "options" => [
                "submitForSettlement" => true
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "La transazione è andata a buon fine!"
            ];

            return response()->json($data,200);
        } else {
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!"
            ];
            return response()->json($data,401);
        }
    }
}
