<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function facebookLogin()
    {
//        return Socialite::driver('facebook')->redirect();

        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'phone', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->redirect();
    }

    public function facebookRedirect()
    {

        $user = Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->user();
        // stroing data to our use table and logging them in
        $data = [
            'provider_id' => $user->getId(),
            'name' => $user->getName(),
            'first_name' => $user->getName(),
            'email' => $user->getEmail()
        ];


        //after login redirecting to home page
        dd($user);

//        $user = Socialite::driver('facebook')->redirect();
//
//        dd($user);
//
//        $data = User::query()->where('email', $user->email)->first();
//
//        if (is_null($data)) {
//            $users['name'] = $user->nickname;
//            $users['email'] = $user->email;
//            $data = User::query()->create($users);
//        }
//
//        Auth::login($data);
//
//        return redirect('log');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        $googleUser = Socialite::driver('google')->redirect();

        $user = User::query()->updateOrCreate([
            'provider_id' => $googleUser->id,
        ], [
            'provider_id' => $googleUser->id,
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
