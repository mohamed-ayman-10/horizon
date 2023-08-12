<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NameCategory;
use Illuminate\Http\Request;

class NameCategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = NameCategory::all();
            return view('admin.pages.name category.index', compact('categories'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required'
            ]);

            NameCategory::query()->create($request->except('_token'));
            return back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required'
            ]);

            NameCategory::query()->findOrFail($id)->update($request->only('title'));
            return back()->with('success', 'Update Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        NameCategory::destroy($id);
        return back()->with('success', 'Delete Successfully');
    }
}
