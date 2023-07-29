<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductSectionController extends Controller
{
    public function index()
    {
        $sections = Section::query()->orderBy('order', 'asc')->get();
        return view('admin.pages.sections.all product.index', compact('sections'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:2',
                'order' => 'required'
            ]);

            Section::query()->create($request->except('_token'));

            return redirect()->back()->with('success', 'Create Successfully');

        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $sections = Section::query()->findOrFail($id);
            $products = $sections->products;
            return view('admin.pages.sections.all product.products', compact('products', 'id'));

        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Section::destroy($id);
        return redirect()->back()->with('success', 'Delete Successfully');
    }
}
