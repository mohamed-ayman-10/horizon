<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kavenegar\Enums\General;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:categories', ['only' => ['index']]);
        $this->middleware('permission:create category', ['only' => ['store']]);
        $this->middleware('permission:update category', ['only' => ['update']]);
        $this->middleware('permission:delete category', ['only' => ['destroy']]);
    }


    public function index()
    {
        $categories = Category::all();
        $mainCategories = Category::query()->whereNull('parent')->get();
//        return $mainCategories;
        return view('admin.category.index', compact('categories', 'mainCategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
                'image' => 'required'
            ]);

//            return $request;

            $category = new Category();
            $category->title = [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ];
            $category->parent = $request->category_id;
//                $category->image = Storage::disk('uploadFile')->put('categories', $request->image);
            if ($request->file('image')) {
                $category->image = FileUpload::File('images/categories', $request->image);
            }
            $category->save();

            return back()->with('success', 'Created Successfully');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
            ]);

            $category = Category::query()->findOrFail($request->id);
            $category->title = [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ];
            $category->parent = $request->category_id;
            if ($request->hasFile('image')) {
                if (file_exists($category->image)) {
                    unlink($category->image);
                }
                $category->image = FileUpload::File('images/categories', $request->image);
            };
            $category->save();

            if ($request->category_id) {
                $subCategory = Category::query()->where('parent', $request->id)->get();
                foreach ($subCategory as $cat) {
                    $cat->update(['parent' => $request->category_id]);
                }
            }
            return back()->with('success', 'Updated Successfully');

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $category = Category::where('id', $id)->first();
            $subCategories = Category::where('parent', $id)->get();
            foreach ($subCategories as $cat) {
                Storage::disk('uploadFile')->delete($cat->image);
                $cat->delete();
            }
            Storage::disk('uploadFile')->delete($category->image);
            Category::destroy($id);
            return back()->with('success', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
