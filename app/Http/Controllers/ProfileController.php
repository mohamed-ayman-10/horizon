<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;


class ProfileController extends Controller
{

    public function show_profile_admin($id)
    {

        $admin = Admin::findOrFail($id);
        return view('admin/profile/index', compact('admin'));
    }

    public function save_profile_admin(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:vendors,email,' . $request->admin_id,
                'password' => 'confirmed',
            ]);
            if ($request->password) {
                Admin::where('id', $request->admin_id)->update([
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                    'email' => $request->email
                ]);

            } else {
                Admin::where('id', $request->admin_id)->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            }

            return back()->with('success', 'Updated Successfully');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }

    }

    public function show_profile_vendor($id)
    {

        $vendor = Vendor::findOrFail($id);
        return view('Vendor/profile/index', compact('vendor'));
    }

    public function verified_vendor(Request $request)
    {
        $ven = Vendor::where('id', $request->vendor_id)->get();
        $vendor =$ven[0];

        if ($vendor->phone_verified == $request->code) {

            Vendor::where('id',$request->vendor_id)->update([
                'phone_verified'=>1
            ]);
            return view('vendor/auth/login');
        } else {
            return   view('vendor/auth/phoneV',compact('vendor'));
        }
    }
    public function get_page_verified ($id){
        $vendor = Vendor::where('id',$id)->get();

        return view('Vendor/auth/phoneV', compact('vendor'));

    }

}
