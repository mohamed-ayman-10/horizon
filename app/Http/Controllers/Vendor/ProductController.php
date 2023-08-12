<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('vendor.pages.product.index', compact('products'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            return $request;

            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
                'price' => 'required',
                'quantity' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'images' => 'required',
                'category_id' => 'required'
            ]);


            $product = new Product();
            $product->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->start_date = $request->start_date;
            $product->end_date = $request->end_date;
            $product->category_id = $request->category_id;
            $product->vendor_id = Auth::user()->id;
            $product->save();

            if ($request->file('images'))
                foreach ($request->images as $file) {
                    $image = new Image();
                    $image->product_id = $product->id;
                    $image->path = FileUpload::File('images/products', $file);
                    $image->save();
                }


            DB::commit();
            return back()->with('success', 'Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request)
    {

        try {

            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
                'price' => 'required',
                'quantity' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'category_id' => 'required',
                'id' => 'required',
            ]);

            $product = Product::query()->findOrFail($request->id);
            $product->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->start_date = $request->start_date;
            $product->end_date = $request->end_date;
            $product->category_id = $request->category_id;
            $product->save();


            return back()->with('success', 'Updated Successfully');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function images($id)
    {
        try {

            $images = Image::query()->where('product_id', $id)->get();
            return view('vendor.pages.product.images', compact('images', 'id'));
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function storeImages(Request $request)
    {
        try {

            foreach ($request->images as $file) {
                $image = new Image();
                $image->path = FileUpload::File('product', $file);
                $image->product_id = $request->product_id;
                $image->save();
            }

            return back()->with('success', 'Created Successfully');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function updateImage(Request $request, $id)
    {
        try {

            $request->validate([
                'image' => 'required'
            ]);

            $image = Image::query()->findOrFail($id);
            FileUpload::Delete($image->path);
            $image->path = FileUpload::File('product', $request->file('image'));
            $image->save();

            return back()->with('success', 'Updated Successfully');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroyImage($id)
    {
        try {

            $image = Image::query()->findOrFail($id);
            FileUpload::Delete($image->path);
            $image->delete();

            return back()->with('success', 'Image Deleted!');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {

            $product = Product::query()->findOrFail($id);


            foreach ($product->images as $image) {
                Storage::disk('uploadFile')->delete($image->path);
            }

            $product->delete();

            return back()->with('success', 'Deleted Successfully');
        } catch (\Exception $exception) {
            return back()->withErrors(['error', $exception->getMessage()]);
        }
    }
}
