<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfferSection;
use App\Models\Product;
use App\Models\WeeklyOfferSection;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function offers()
    {
        try {

            $offers = OfferSection::query()->pluck('product_id');
            if (count($offers) > 0) {
                $products = Product::query()->whereIn('id', $offers)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function weeklyOffers()
    {
        try {

            $offers = WeeklyOfferSection::query()->pluck('product_id');
            if (count($offers) > 0) {
                $products = Product::query()->whereIn('id', $offers)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
