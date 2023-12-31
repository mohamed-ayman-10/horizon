<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSection;
use App\Models\Section;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $section_id = $request->section_id;
        $products = Product::all();
        return view('admin.pages.sections.all product.create product', compact('products', 'section_id'));
    }

    public function store(Request $request)
    {
        try {

            $section = Section::query()->findOrFail($request->section_id);
            $section->products()->syncWithoutDetaching($request->ids);
            return redirect()->route('admin.product_section.show', $request->section_id)->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        return $id;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        ProductSection::query()->where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function search(Request $request)
    {
        $products = Product::get();
        return $products;
    }

}
