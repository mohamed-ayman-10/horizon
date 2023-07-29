<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;

class TechnicalSupportController extends Controller
{
    public function orders() {
        try {
            return view('admin.pages.technical support.orders');
        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function SearchOrders(Request $request) {
        try {
            $order = Order::query()->where('id', $request->order_id)->first();
            return view('admin.pages.technical support.orders', compact('order'));
        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function vendors() {
        try {
            return view('admin.pages.technical support.vendors');
        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function Searchvendors(Request $request) {
        try {
            $vendor = Vendor::query()->where('phone', $request->phone)->first();
            $orders = Order::query()->where('vendor_id', $vendor->id)->limit(3)->get();
            return view('admin.pages.technical support.vendors', compact('vendor', 'orders'));
        }catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
