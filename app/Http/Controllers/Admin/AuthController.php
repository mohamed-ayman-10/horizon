<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function credentials(Request $request) {

    }

    public function postLogin(Request $request) {
        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if (Auth::guard('admin')->attempt(['password' => $request->password, 'email' => $request->email, 'status'=> '1']))
                return redirect(RouteServiceProvider::ADMIN);
            else
                return back()->withErrors(['error' => 'Incorrect email address or password, please try again']);

            return redirect()->route('admin.auth.login');

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function register() {
        return view('admin.auth.register');
    }

    public function postRegister(Request $request) {
        try {

            $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:vendors,email',
                'password' => 'required|string',
            ]);

            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->save();

            return redirect()->route('admin.auth.login');

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }
}
