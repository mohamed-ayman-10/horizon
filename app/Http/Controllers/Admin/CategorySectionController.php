<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorySection;
use App\Models\Product;
use App\Models\ProductSection;
use App\Models\Section;
use Illuminate\Http\Request;

class CategorySectionController extends Controller
{

    public function products($id)
    {
        try {
            $section = CategorySection::query()->findOrFail($id);
            $products = $section->products;
            return view('admin.pages.category section.products', compact('products', 'id'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        $section_id = $request->section_id;
        $products = Product::all();
        return view('admin.pages.category section.create product', compact('products', 'section_id'));
    }

    public function storeProduct(Request $request)
    {
        $section = CategorySection::query()->findOrFail($request->section_id);
        $section->products()->syncWithoutDetaching($request->ids);
        return redirect()->route('admin.category_section.products', $request->section_id)->with('success', 'Create Successfully');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'category_id' => 'required',
                'title' => 'required|string|min:2'
            ]);

            CategorySection::query()->create($request->except('_token'));

            return back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        $section = CategorySection::query()->where('category_id', $id)->get();
        return view('admin.pages.category section.index', compact('section', 'id'));
    }


    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'title' => 'required|string|min:2'
            ]);

            CategorySection::query()->where('id', $id)->update($request->only('title'));

            return back()->with('success', 'Update Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        CategorySection::destroy($id);
        return back()->with('success', 'Delete Successfully');
    }

    public function delete($id)
    {
        ProductSection::query()->where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function search(Request $request)
    {
        try {

            return $request;

            $products = Product::query()
                ->where('id', 'link', '%' . $request->string . '%')
                ->orWhere('name', 'link', '%' . $request->string . '%')
                ->get();

            return $products;

//            if ($products->count() >= 1) {
//                return view('search_product.blade', compact('products'))->render();
//            } else {
//                return response()->json([
//                    'status' => 'nothing_found',
//                ]);
//            }
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
