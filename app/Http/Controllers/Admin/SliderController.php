<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Slider;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:slider', ['only' => ['index']]);
        $this->middleware('permission:create slider', ['only' => ['create']]);
        $this->middleware('permission:update slider', ['only' => ['update']]);
        $this->middleware('permission:delete slider', ['only' => ['delete']]);
    }

    public function index()
    {
        $slider = Slider::all();

        return view('admin/slider/index', compact('slider'));

    }

    public function create(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'image' => 'required',

        ]);
        if ($request->file('image')) {

            Slider::create([
                'title' => [
                    'en' => $request->title_en,
                    'ar' => $request->title_ar,
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar,
                ],

                'image' => FileUpload::File('slider', $request->file('image'))
            ]);
            return back()->with('success', 'Created Successfully');

        }
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'title_en' => 'required',
                'title_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',

            ]);

            $slider = Slider::query()->findOrFail($request->id);
            $slider->title = [
                'ar' => 'title_ar',
                'en' => 'title_en',
            ];
            $slider->description = [
                'ar' => 'description_ar',
                'en' => 'description_en',
            ];
            if ($request->hasFile('image')) {
                FileUpload::Delete($slider->image);
                $slider->image = FileUpload::File('slider', $request->file('image'));
            }
            $slider->save();

            return back()->with('success', 'Update Successfully');

        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function delete($id)
    {


        $slider = Slider::query()->findOrFail($id);
        FileUpload::Delete($slider->image);

        Slider::destroy($id);
        return back()->with('success', 'Deleted Successfully');


    }


}
