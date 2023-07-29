<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $home =  Home::all();
        $iteme = $home[0];



        return view('admin/home/index', compact('iteme'));
    }

    public function update(Request $request)
    {
        if ($request->file('logo')) {
            $file =  Storage::disk('uploadFile')->put('logo', $request->logo);


            if ($count = Home::count() == 0) {
                Home::create([
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'whatsapp' => $request->whatsapp,
                    'logo' => $file
                ]);
            } else {

                Home::where('id', 1)->update([
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'whatsapp' => $request->whatsapp,
                    'logo' => $file
                ]);
            }
            return back()->with('success', 'Update Successfully');
        } else {
            if ($count = Home::count() == 0) {
                Home::create([
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'whatsapp' => $request->whatsapp,

                ]);
            } else {

                Home::where('id', 1)->update([
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'whatsapp' => $request->whatsapp,

                ]);
            }
            return back()->with('success', 'Update Successfully');
        }


    }
    public function about (){

    }
}
