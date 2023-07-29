<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Image;
use App\Models\Product;
use App\Traits\FileUpload;
use App\Traits\GeneralApi;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show()
    {
        $products = Product::query()->where('vendor_id', Auth::guard('vendor_api')->user()->id)->with('images', 'category')->get();
        return GeneralApi::returnData(200, 'Successfully', $products);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'title_ar' => 'required|string|min:2',
                'title_en' => 'required|string|min:2',
                'start_date' => 'required|string|date|min:2',
                'quantity' => 'required|string',
                'price' => 'required|string',
                'category_id' => 'required',
                'images' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (!$request->hasFile('images')) {
                return response()->json(['upload_file_not_found'], 400);
            }
            $file = $request->file('images');
            if (!$file->isValid()) {
                return response()->json(['invalid_file_upload'], 400);
            }


            $product = new Product();
            $product->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->start_date = $request->start_date;
            $product->category_id = $request->category_id;
            $product->vendor_id = Auth::guard('vendor_api')->user()->id;
            $product->save();

            $image = new Image();
            $image->product_id = $product->id;
            $image->path = FileUpload::File('product', $file);
            $image->save();

            DB::commit();
            return GeneralApi::returnData(201, 'Create Successfully', $product);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->json($exception->getMessage());
        }

    }

    public function getProductById(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $product = Product::query()->with('images', 'category')->where('vendor_id', \auth('vendor_api')->user()->id)->findOrFail($request->id);

        if (!$product) {
            return GeneralApi::returnData('204', 'No Content', []);
        }

        return GeneralApi::returnData('200', 'Successfully', $product);
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'title_ar' => 'required|string|min:2',
                'title_en' => 'required|string|min:2',
                'start_date' => 'required|string|date|min:2',
                'quantity' => 'required|string',
                'price' => 'required|string',
                'category_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if ($request->hasFile('images')) {
                if (!$request->hasFile('images')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $request->file('images');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
            }

            $product = Product::query()->where('vendor_id', \auth('vendor_api')->user()->id)->findOrFail($id);
            $product->title = [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ];
            $product->start_date = $request->start_date;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->vendor_id = Auth::guard('vendor_api')->user()->id;
            $product->save();

            if ($request->hasFile('images')) {
                $image = Image::query()->where('product_id', $id)->firstOrFail();
                FileUpload::Delete($image->path);
                $image->path = FileUpload::File('product', $file);
                $image->save();
            }

            DB::commit();
            return GeneralApi::returnData(201, 'Update Successfully', $product);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage());
        }

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $product = Product::query()->where('vendor_id', auth('vendor_api')->user()->id)
                ->where('id', $id)
                ->first();


            $image = Image::query()->where('product_id', $product->id)->first();

            FileUpload::Delete($image->path);

            $product->delete();
            $image->delete();

            DB::commit();
            return GeneralApi::returnData(200, 'Delete Successfully', $product);
        }catch (\Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage());
        }



    }
}
