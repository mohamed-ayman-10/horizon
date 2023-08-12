<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Whatsapp;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function index() {
        $data = Whatsapp::query()->first();
        return view('admin.pages.whatsapp.index', compact('data'));
    }

    public function store(Request $request) {

        try {

            $request->validate([
                'number' => 'required',
                'title_ar' => 'required|string',
                'title_en' => 'required|string',
                'description_ar' => 'required|string',
                'description_en' => 'required|string',
                'button_ar' => 'required|string',
                'button_en' => 'required|string',
            ]);

            $data = Whatsapp::query()->first();
            $data->number = $request->number;
            $data->title = [
                'ar'=>$request->title_ar,
                'en'=>$request->title_en,
            ];
            $data->description = [
                'ar'=>$request->description_ar,
                'en'=>$request->description_en,
            ];
            $data->button = [
                'ar'=>$request->button_ar,
                'en'=>$request->button_en,
            ];
            $data->save();

            return back()->with('success', 'Update Successfully');

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
