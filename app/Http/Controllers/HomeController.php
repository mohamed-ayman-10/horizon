<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $item = Home::query()->first();
        return view('admin/home/index', compact('item'));
    }

    public function store(Request $request)
    {
        try {

            $data = $request->except('_token');
            if ($request->hasFile('logo')) {
                $data['logo'] = FileUpload::File('logo', $request->logo);
            }

            Home::query()->create($data);

            return back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {

            $data = $request->except('_token');
            $setting = Home::query()->firstOrFail();
            if ($request->hasFile('logo')) {
                FileUpload::Delete($setting->logo);
                $data['logo'] = FileUpload::File('logo', $request->logo);
            }

            $setting->update($data);

            return back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function about()
    {

    }
}
