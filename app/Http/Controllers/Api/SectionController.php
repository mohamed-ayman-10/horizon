<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FirstProduct;
use App\Models\FristCategory;
use App\Models\LastCategory;
use App\Models\LastProduct;
use App\Models\OfferSection;
use App\Models\Product;
use App\Models\Section;
use App\Models\WeeklyOfferSection;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function allProductSection() {
        try {

            $sections = Section::query()->with('products.images')->paginate(5);
            return GeneralApi::returnData(200, 'success', $sections);

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function allProduct() {
        try {

            $sections = Product::query()->with('images')->paginate(5);
            return GeneralApi::returnData(200, 'success', $sections);

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
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

    public function firstCategory()
    {
        try {

            $categories = FristCategory::query()->pluck('product_id');
            if (count($categories) > 0) {
                $products = Product::query()->whereIn('id', $categories)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function lastCategory()
    {
        try {

            $categories = LastCategory::query()->pluck('product_id');
            if (count($categories) > 0) {
                $products = Product::query()->whereIn('id', $categories)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function firstProduct()
    {
        try {

            $data = FirstProduct::query()->pluck('product_id');
            if (count($data) > 0) {
                $products = Product::query()->whereIn('id', $data)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function lastProduct()
    {
        try {

            $data = LastProduct::query()->pluck('product_id');
            if (count($data) > 0) {
                $products = Product::query()->whereIn('id', $data)->with('images', 'category')->get();
                return GeneralApi::returnData(200, 'Success', $products);
            } else {
                return GeneralApi::returnData(204, 'No Data', []);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
