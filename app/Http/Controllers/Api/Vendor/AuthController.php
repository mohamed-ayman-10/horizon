<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:vendor_api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('vendor_api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone' => 'required|max:11|unique:vendors,phone',
            'governorate_id' => 'required',
            'email' => 'required|string|email|max:100|unique:vendors,email',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->cash_number = $request->cash_number;
        $vendor->email = $request->email;
        $vendor->password = bcrypt($request->password);
        $vendor->governorate_id = $request->governorate_id;

        if ($request->file('image')) {
            $vendor->image = FileUpload::File('images/vendor', $request->image);
        }
        $vendor->save();

        return response()->json([
            'message' => 'Vendor successfully registered',
            'vendor' => $vendor
        ], 201);
    }

    public function updateVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone' => 'required|max:11|unique:vendors,phone,' . auth('vendor_api')->user()->id,
            'governorate_id' => 'required',
            'email' => 'required|string|email|max:100|unique:vendors,email,' . auth('vendor_api')->user()->id,
            'password' => 'string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $vendor = Vendor::query()->findOrFail(auth('vendor_api')->user()->id);
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->cash_number = $request->cash_number;
        $vendor->governorate_id = $request->governorate_id;
        $vendor->email = $request->email;
        if ($request->password) {
            $vendor->password = bcrypt($request->password);
        }
        if ($request->file('image')) {
            if (file_exists($vendor->image)) {
                unlink($vendor->image);
            }
            $vendor->image = FileUpload::File('images/vendor', $request->image);
        }

        $vendor->save();

        return response()->json([
            'message' => 'User successfully Update',
            'user' => $vendor
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('vendor_api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('vendor_api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('vendor_api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('vendor_api')->factory()->getTTL() * 60 * 24 * 30,
            'user' => auth('vendor_api')->user()
        ]);
    }
}
