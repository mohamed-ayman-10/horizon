<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use App\Models\OfferSection;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = OfferSection::all();
        $products = Product::all();
        return view('admin.pages.sections.offers.index', compact('offers', 'products'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'ids' => 'required'
            ], [
                'ids' => 'Please Select Product'
            ]);

            foreach ($request->ids as $id) {
                OfferSection::query()->create(['product_id' => $id]);
            }

            return redirect()->back()->with('success', 'Add Product Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // return 123;
        OfferSection::destroy($id);
        return redirect()->back()->with('success', 'Delete Product Successfully');
    }
}
