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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $section_id = $request->section_id;
        $products = Product::all();
        return view('admin.pages.sections.all product.create product', compact('products', 'section_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
