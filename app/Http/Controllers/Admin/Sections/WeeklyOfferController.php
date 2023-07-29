<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\WeeklyOfferSection;
use App\Http\Controllers\Controller;

class WeeklyOfferController extends Controller
{
    public function index()
    {
        $offers = WeeklyOfferSection::all();
        $products = Product::all();
        return view('admin.pages.sections.weekly offers.index', compact('offers', 'products'));
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
                WeeklyOfferSection::query()->create(['product_id' => $id]);
            }

            return redirect()->back()->with('success', 'Add Product Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        WeeklyOfferSection::destroy($id);
        return redirect()->back()->with('success', 'Delete Product Successfully');
    }
}
