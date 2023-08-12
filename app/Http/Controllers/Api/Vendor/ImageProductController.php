<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Traits\FileUpload;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class ImageProductController extends Controller
{
    public function store(Request $request) {
        try {

            $request->validate([
                'image' => 'required',
                'product_id' => 'required',
            ]);

            $image = new Image();
            $image->product_id = $request->product_id;
            $image->path = FileUpload::File('images/products', $request->image);
            $image->save();

            return GeneralApi::returnData(200, 'success', $image);

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'image' => 'required',
                'id' => 'required',
            ]);

            $image = Image::query()->findOrFail($request->id);
            FileUpload::Delete($image->path);
            $image->path = FileUpload::File('images/products', $request->image);
            $image->save();

            return GeneralApi::returnData(200, 'success', $image);

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function destroy(Request $request) {
        try {

            $image = Image::query()->findOrFail($request->id);
            FileUpload::Delete($image->path);
            $image->delete();

            return GeneralApi::returnData(200, 'success', $image);

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
