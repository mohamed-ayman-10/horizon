<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slider;
use App\Models\VendorMessage;
use App\Models\VendorNotification;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function category()
    {
        $category = Category::all();

        if ($category->count() == 0) {
            return response()->json([
                "status" => 204,
                "msg" => "No Content",
                "data" => []
            ]);
        }
        if (!$category) {
            return response()->json([
                "status" => 404,
                "msg" => "Not Found",
                "data" => []
            ]);
        }
        return response()->json([
            "status" => 200,
            "msg" => "Successfully",
            "data" => $category
        ]);
    }

    public function findCategory($id)
    {
        $category = Category::query()->findOrFail($id);

        if ($category->count() == 0) {
            return GeneralApi::returnData(204, 'No Content', []);
        }
        if (!$category) {
            return GeneralApi::returnData(404, 'No Found', []);
        }
        return GeneralApi::returnData(200, 'Successfully', $category);
    }

    public function products()
    {
        $products = Product::query()
            ->where('status', 1)
            ->select('id', 'title', 'start_date', 'end_date', 'quantity', 'total_price')
            ->with('images')
            ->get();

        if ($products->count() == 0) {
            return GeneralApi::returnData(204, 'No Content', []);
        }
        if (!$products) {
            return GeneralApi::returnData(404, 'No Found', []);
        }
        return GeneralApi::returnData(200, 'Successfully', $products);
    }

    public function productWithCategory()
    {
        $products = Product::with('category', 'images')->get();


        if ($products->count() == 0) {
            return GeneralApi::returnData(204, 'No Content', []);
        }
        if (!$products) {
            return GeneralApi::returnData(404, 'No Found', []);
        }
        return GeneralApi::returnData(200, 'Successfully', $products);
    }

    public function productWithCategoryId($id)
    {
        $product = Product::query()->where('category_id', $id)->with('images')->get();
        return GeneralApi::returnData(201, 'Success', $product);
    }

    public function getProductById(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $product = Product::query()->with('images', 'category')->findOrFail($request->id);

        if (!$product) {
            return GeneralApi::returnData('204', 'No Content', []);
        }

        return GeneralApi::returnData('200', 'Successfully', $product);

    }

    public function All_Slider()
    {
        $slider = Slider::all();

        if ($slider->count() == 0) {
            return response()->json([
                "status" => 204,
                "msg" => "No Content",
                "data" => []
            ]);
        }
        return response()->json([
            "status" => 200,
            "msg" => "Successfully",
            "data" => $slider
        ]);
    }

    public function about()
    {

        $about = Home::all();

        return response()->json([
            "status" => 200,
            "msg" => "Successfully",
            "data" => $about[0]
        ]);
    }

    public function vendorMessages()
    {
        try {
            $message = VendorMessage::query()->where('vendor_id', auth('vendor_api')->user()->id)->get();
            if (count($message) > 0) {
                return GeneralApi::returnData(200, 'success', $message);
            } else {
                return GeneralApi::returnData(204, 'no data', []);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function vendorNotifications()
    {
        try {

            $notification = VendorNotification::query()->where('vendor_id', auth('vendor_api')->user()->id)->get();
            if (count($notification) > 0) {
                return GeneralApi::returnData(200, 'success', $notification);
            } else {
                return GeneralApi::returnData(204, 'no data', []);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function sections()
    {
        try {

            $sections = Section::query()->with('products.images')->get();
            if (count($sections) > 0) {
                return GeneralApi::returnData(200, 'success', $sections);
            } else {
                return GeneralApi::returnData(204, 'no data', []);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
