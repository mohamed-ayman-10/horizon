<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('vendor.pages.category.index', compact('categories'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
            ]);

            $category = new Category();
            $category->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $category->save();

            return back()->with('success', 'Created Successfully');
        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request) {

        try {
            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
                'id' => 'required|string',
            ]);


            $category = Category::query()->findOrFail($request->id);
            $category->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $category->save();

            return back()->with('success', 'Updated Successfully');
        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id) {
        try {

            Category::destroy($id);
            return back()->with('success', 'Deleted Successfully');

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
