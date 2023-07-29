<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:categories', ['only' => ['index']]);
        $this->middleware('permission:create category', ['only' => ['store']]);
        $this->middleware('permission:update category', ['only' => ['update']]);
        $this->middleware('permission:delete category', ['only' => ['destroy']]);
    }


    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request) {
//
        if ($request->file('image')){
            try {
                $request->validate([
                    'title_en' => 'required|string|min:2',
                    'title_ar' => 'required|string|min:2',
                    'image'=> 'required'
                ]);

                $category = new Category();
                $category->title = [
                    'en' => $request->title_en,
                    'ar' => $request->title_ar,
                ];
                $category->image = Storage::disk('uploadFile')->put('categories', $request->image);
                $category->image = FileUpload::File('category', $request->image);

                $category->save();

                return back()->with('success', 'Created Successfully');
            }catch (\Exception $exception) {
                return back()->withErrors(['error' => $exception->getMessage()]);
            }
        }


    }

    public function update(Request $request) {
        try {

            $request->validate([
                'title_en' => 'required|string|min:2',
                'title_ar' => 'required|string|min:2',
            ]);


            $category = Category::query()->findOrFail($request->id);
//            return $category;
            $category->title = [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ];
            if ($request->hasFile('image')) {
                FileUpload::Delete($category->image);
                $category->image = FileUpload::File('category', $request->file('image'));
            };
            $category->save();

            return back()->with('success', 'Updated Successfully');

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }

    }

    public function destroy($id) {
        try {
            $cat = Category::where('id',$id)->get();
            Storage::disk('uploadFile')->delete($cat[0]->image);
            Category::destroy($id);
            return back()->with('success', 'Deleted Successfully');

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
