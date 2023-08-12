<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAdd;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class LoginAddController extends Controller
{
    public function index()
    {
        $data = LoginAdd::all();
        return view('admin.pages.login add.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required'
            ]);


            LoginAdd::query()->create([
                'image' => FileUpload::File('images/ads', $request->image)
            ]);

            return back()->withSuccess('Create Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'required'
            ]);


            $data = LoginAdd::query()->findOrFail($id);
            if (file_exists($data->image)) {
                FileUpload::Delete($data->image);
            }
            $data->image = FileUpload::File('images/ads', $request->file('image'));
            $data->save();

            return redirect()->back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {

            $data = LoginAdd::query()->findOrFail($id);
            if (file_exists($data->image)) {
                FileUpload::Delete($data->image);
            }
            $data->delete();

            return redirect()->back()->with('success', 'Create Successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
