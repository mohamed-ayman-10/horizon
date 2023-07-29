<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity_product;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function my_card()
    {

        $product_ids = Card::query()->where('user_id', auth('api')->user()->id)->pluck('product_id');

        $products = Product::query()->whereIn('id', $product_ids)->with('quantityOfCart', 'images', 'category')->get();

        if (!$products) {
            return GeneralApi::returnData(204, 'No content', []);
        }

        return GeneralApi::returnData('200', 'Successfully', $products);
    }

    public function add_to_card(Request $request)
    {

        if (Card::query()->where('user_id', auth('api')->user()->id)->where('product_id', $request->product_id)->count() >= 1) {
            return response()->json('The product already exists');
        }

        Card::create([
            'user_id' => auth('api')->user()->id,
            'product_id' => $request->product_id
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = Quantity_product::create([
            'user_id' => auth('api')->user()->id,
            'product_id' => $request->product_id,
            'total' => $product->price,
        ]);
        return response()->json([
            "status" => 200,
            "msg" => "Successfully",
            "product" => $product
        ]);
    }

    public function delete_product_in_my_card($id)
    {
        DB::table('cards')->where('product_id', $id)->where('user_id', auth('api')->user()->id)->delete();
        Quantity_product::query()->where('product_id', $id)->where('user_id', auth('api')->user()->id)->delete();
        return response()->json([
            "status" => 200,
            "msg" => "Deleted Successfully",
            "data" => []
        ]);
    }

    public function update_quantity_product_in_my_card(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'product_id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($request->product_id);
        $total = $product->price * $request->quantity;


        Quantity_product::where('product_id', $product->id)->where('user_id', auth('api')->user()->id)->update([
            'quantity' => $request->quantity,
            'total' => $total,
        ]);


        return response()->json([
            "status" => 200,
            "msg" => "Update Successfully",
            "data" => [
                'quantity' => $request->quantity,
                'total' => $total
            ]
        ]);
    }

    public function get_total()
    {
        $total = Quantity_product::where('user_id', auth('api')->user()->id)->sum('total');
        return response()->json([
            "status" => 200,
            "msg" => "Update Successfully",
            "data" => [
                'total' => $total
            ]

        ]);
    }

    public function userOrder() {
        try{

            $orders = Order::query()->where('user_id', auth('api')->user()->id)->with('product')->get();

            if(count($orders) > 0) {
                return GeneralApi::returnData(200, 'Success', $orders);
            }else {
                return GeneralApi::returnData(204, 'No Data', []);
            }

        }catch(\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
