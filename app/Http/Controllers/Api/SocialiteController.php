<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    public function socialite(Request $request)
    {
        try {
            $request->validate([
                'provider_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ]);

            $data = User::query()->updateOrCreate([
                'provider_id' => $request->provider_id
            ], [
                'provider_id' => $request->provider_id,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email
            ]);

            $log = auth('api')->login($data);

            return $this->createNewToken($log);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
    public function facebookLogin(Request $request)
    {
//        return Socialite::driver('facebook')->redirect();

        $data = User::query()->updateOrCreate([
            'provider_id' => $request->provider_id
        ], [
            'provider_id' => $request->provider_id,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email
        ]);

        $log = auth('api')->login($data);

        return $this->createNewToken($log);

    }


    public function facebookRedirect()
    {

        $user = Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->user();

//        dd($user->token);

        $data = User::query()->updateOrCreate([
            'provider_id' => $user["id"]
        ], [
            'provider_id' => $user["id"],
            'name' => $user["first_name"] . ' ' . $user["last_name"],
            'email' => $user["email"]
        ]);

        $log = auth('api')->login($data);

        return $this->createNewToken($log);
    }


    public function googleLogin(Request $request)
    {
//        return Socialite::driver('google')->redirect();

        $data = User::query()->updateOrCreate([
            'provider_id' => $request->provider_id
        ], [
            'provider_id' => $request->provider_id,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email
        ]);

        $log = auth('api')->login($data);

        return $this->createNewToken($log);

    }

    public function googleRedirect()
    {
        $user = Socialite::driver('google')->stateless()->redirect();
//        $finduser = User::query()->where('gauth_id', $user->id)->first();

        dd($user);
//        $user = User::query()->updateOrCreate([
//            'provider_id' => $googleUser->id,
//        ], [
//            'provider_id' => $googleUser->id,
//            'name' => $googleUser->name,
//            'email' => $googleUser->email,
//        ]);

        dd($googleUser);

        Auth::login($user);

        return redirect('/dashboard');
    }


    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 24 * 30,
            'user' => auth('api')->user()
        ]);
    }

}
