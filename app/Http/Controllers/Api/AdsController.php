<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoginAdd;
use App\Models\ModalAdd;
use App\Traits\GeneralApi;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function modalAds() {
        try {

            $ads = ModalAdd::all();

            return GeneralApi::returnData(200, 'success', $ads);

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function loginAds() {
        try {

            $ads = LoginAdd::all();

            return GeneralApi::returnData(200, 'success', $ads);

        }catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
