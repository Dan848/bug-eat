<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirm;
use App\Models\Lead;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
{
    $restaurant_email = $request->restaurant_email;
    $user_email = $request->user_email;
    $data = $request->all();
    $newOrder = Order::create($data);
    $newOrder->save();

    $collection = collect($request->products)->mapWithKeys(function ($product) {
        return [$product['id'] => ['quantity' => $product['quantity']]];
    });
    $newOrder->products->sync($collection);

    // $new_lead = new Lead();
    // $new_lead->order_num = $newOrder->id;
    // $new_lead->products = $data['products']; // Assuming 'products' is an array in $data
    // $new_lead->total = $newOrder->total_price;

    // Mail::to($restaurant_email)->send(new OrderConfirm($new_lead));
    // Mail::to($user_email)->send(new OrderConfirm($new_lead));

    // Return the response to stop axios (if necessary) before sending emails
    return response()->json([
        'success' => true,
        "data" => $data,
    ]);

    // The following code will not execute as it comes after the return statement

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
