<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
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

            $data = Vendor::query()->updateOrCreate([
                'provider_id' => $request->provider_id
            ], [
                'provider_id' => $request->provider_id,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email
            ]);

            $log = auth('vendor_api')->login($data);

            return $this->createNewToken($log);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
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
