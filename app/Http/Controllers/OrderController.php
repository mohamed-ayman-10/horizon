<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\Quantity_product;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {

        $user_id = auth('api')->user()->id;

        $products = Quantity_product::query()->where('user_id', $user_id)->get();

        $amount_cents = $products->sum('total') * 100;

        foreach ($products as $product) {
            Order::query()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'apartment' => $request->apartment,
                'floor' => $request->floor,
                'street' => $request->street,
                'building' => $request->building,
                'payment_status' => 0,
                'notes' => $request->notes,
                'product_id' => $product->product_id,
                'user_id' => $user_id,
                'quantity' => $product->quantity,
                'total_price' => $product->total,
            ]);

            $product->delete();
            Card::query()->where('user_id', $user_id)->where('product_id', $product->product_id)->delete();
        }

        return GeneralApi::returnData(200, 'Successfully', []);

    }

}
