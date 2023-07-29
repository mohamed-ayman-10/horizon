<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        try {

            $orders = Order::query()->where('vendor_id', auth('vendor_api')->user()->id)->with('product')->get();
            return $orders;

            if (count($orders) == 0) {
                return GeneralApi::returnData(204, 'No Content', []);
            }
            return GeneralApi::returnData(200, 'Success', $orders);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function orderByProductId($product_id)
    {
        try {

            $order = Order::query()
                ->where('product_id', $product_id)
                ->where('vendor_id', auth('vendor_api')->user()->id)
                ->get();

            if (count($order) == 0) {
                return GeneralApi::returnData(204, 'No Content', []);
            }
            return GeneralApi::returnData(200, 'Success', $order);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
