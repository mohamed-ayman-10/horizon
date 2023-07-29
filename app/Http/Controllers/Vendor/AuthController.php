<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function login()
    {
        return view('vendor.auth.login');
    }

    public function postLogin(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            $ven = Vendor::where('email',$request->email)->get();
            $vendor =$ven[0];
            if ($vendor->phone_verified > 1) {
                $randomNumber = random_int(100000, 999999);

                $sid = env('TwILIO_SID');
                $token = env('TwILIO_TOKEN');
                $number = env('TwILIO_FROM');
                $client = new Client($sid, $token);
                $num = '+2' . $vendor->phone;
                $client->messages->create($num, [
                    'from' => $number,
                    'body' => 'code verified is ' . $randomNumber
                ]);
                Vendor::where('id', $vendor->id)->update([
                    'phone_verified' => $randomNumber
                ]);
                return view('vendor/auth/phoneV', compact('vendor'));
            }
            if (Auth::guard('vendor')->attempt($request->except('_token')))
                return redirect(RouteServiceProvider::VENDOR);
            else
                return back()->withErrors(['error' => 'Incorrect email address or password, please try again']);

            return redirect()->route('vendor.auth.login');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function register()
    {
        return view('vendor.auth.register');
    }

    public function postRegister(Request $request)
    {


        try {
            $randomNumber = random_int(100000, 999999);

            $sid = env('TwILIO_SID');
            $token = env('TwILIO_TOKEN');
            $number = env('TwILIO_FROM');
            $client = new Client($sid, $token);
            $num = '+2' . $request->phone;
            $client->messages->create($num, [
                'from' => $number,
                'body' => 'code verified is ' . $randomNumber
            ]);


            $request->validate([
                'name' => 'required|string|min:2',
                'phone' => 'required|string|min:11',
                'email' => 'required|email|unique:vendors,email',
                'password' => 'required|string',
            ]);

            $vendor = new Vendor();
            $vendor->name = $request->name;
            $vendor->phone = $request->phone;
            $vendor->email = $request->email;
            $vendor->password = bcrypt($request->password);
            $vendor->phone_verified = $randomNumber;
            $vendor->save();


            return view('vendor/auth/phoneV', compact('vendor'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();

        return redirect()->route('vendor.auth.login');
    }

    public function phone_verified()
    {

    }
}
