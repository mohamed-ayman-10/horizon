<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\Product;
use App\Models\Quantity_product;
use App\Traits\FileUpload;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {

        $user_id = auth('api')->user()->id;

        $products = Quantity_product::query()->where('user_id', $user_id)->get();

        if (count($products) < 1) {
            return response()->json('There are no products in the cart!');
        }

        $amount_cents = $products->sum('total') * 100;

        if ($amount_cents < 10) {
            return response()->json('Make sure the product value is greater than or equal to 10.');
        }


//        $items = [];

//        foreach ($products as $product) {
//            array_push($items, [
//                "name" => $product->product->title,
//                "amount_cents" => $product->total * 100,
//                "description" => $product->product->title,
//                "quantity" => $product->quantity
//            ]);
//        }

//        $shipping_data = [
//            "apartment" => $request->apartment,
//            "email" => $request->email,
//            "floor" => $request->floor,
//            "first_name" => $request->first_name,
//            "last_name" => $request->last_name,
//            "street" => $request->street,
//            "building" => $request->building,
//            "phone_number" => $request->phone,
////            "extra_description" => $request->extra_description,
//            "city" => $request->city,
//            "country" => "Egypt",
//        ];

//        $shipping_details = [
//            "notes" => $request->notes,
//            "contents" => "product of some sorts"
//        ];

//        $token = $this->getToken();


//        $data = [
//            "auth_token" => $token,
//            "delivery_needed" => "true",
//            "amount_cents" => $amount_cents,
//            "currency" => "EGP",
//            "items" => $items,
//            "shipping_data" => $shipping_data,
//            "shipping_details" => $shipping_details,
//        ];

//        $order = $this->createOrder($data);


        // Get Payment Token
//        $billingData = [
//            "apartment" => "803",
//            "email" => "$request->email",
//            "floor" => $request->floor,
//            "first_name" => $request->first_name,
//            "last_name" => $request->last_name,
//            "street" => $request->street,
//            "building" => $request->building,
//            "phone_number" => $request->phone,
//            "shipping_method" => "PKG",
//            "city" => $request->city,
//            "country" => "Egypt",
//        ];
//        $dataPaymentToken = [
//            "auth_token" => $token,
//            "amount_cents" => $amount_cents,
//            "expiration" => 3600,
//            "order_id" => $order->id,
//            "billing_data" => $billingData,
//            "currency" => "EGP",
//            "integration_id" => env('PAYMOB_INTEGRATION_ID', 3972843)
//        ];
//
//        $paymentToken = $this->getPaymentToken($dataPaymentToken)->object()->token;


        // Get Wallet Payment Redirect Url
//        $response = Http::post('https://accept.paymob.com/api/acceptance/payments/pay', [
//            "source" => [
//                "identifier" => $request->vodafone_cash_number,
//                "subtype" => "WALLET"
//            ],
//            "payment_token" => $paymentToken
//        ]);


        foreach ($products as $product) {

            try {
                DB::beginTransaction();


                $order = new Order();
                $order->product_id = $product->product_id;
                $order->user_id = $user_id;
                $order->vendor_id = $product->product->vendor_id;
                $order->governorate_id = $request->governorate_id;
                $order->date = date('Y-m-d');
                $order->first_name = $request->first_name;
                $order->last_name = $request->last_name;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->city = $request->city;
                $order->apartment = $request->apartment;
                $order->floor = $request->floor;
                $order->street = $request->street;
                $order->building = $request->building;
                $order->wallet_number = $request->vodafone_cash_number;
                $order->payment_method = $request->payment_method;
                $order->notes = $request->notes;
                $order->quantity = $product->quantity;
                $order->total_price = $product->total;
                if ($request->hasFile('image')) {
                    $order->image = FileUpload::File('order', $request->file('image'));
                }
                $order->save();

                 $productUpdateQuantity = Product::query()->findOrFail($product->product_id);
                 $productUpdateQuantity->quantity = $productUpdateQuantity->quantity - $product->quantity;
                 $productUpdateQuantity->save();

                $product->delete();
                Card::query()->where('user_id', $user_id)->where('product_id', $product->product_id)->delete();

                OrderNotification::query()->create([
                    'date' => date('Y-m-d'),
                    'product_id' => $product->product_id,
                    'user_id' => $user_id,
                    'vendor_id' => $product->product->vendor_id,
                ]);


                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json($exception->getMessage());
            }


        }

        // return \Redirect::away($response->object()->redirect_url);

        return GeneralApi::returnData(200, 'Create Order Successfully', []);


//      return \Redirect::away('https://portal.weaccept.co/api/acceptance/iframes/'.env('PAYMOB_IFRAME_ID').'?payment_token='.$paymentToken);
//        return \Redirect::away('https://accept.paymob.com/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken);
    }

    public function getToken()
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            "username" => "01021811237",
            "password" => "Hamo@108940"
        ]);

        return $response->object()->token;
    }

    public function createOrder($data)
    {
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($dataPaymentToken)
    {
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $dataPaymentToken);
        return $response;
    }

    public function callback(Request $request)
    {

        $data = $request->all();

//        dd($data);
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if (in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC', 'B25FE9EC3B8C8C76ACFABDFE7E4E8B14');
        $hashed = hash_hmac('sha512', $connectedString, $secret);
        if ($hashed == $hmac) {
            echo "secure";
            exit;
        }
        echo 'not secure';
        exit;
    }
}
