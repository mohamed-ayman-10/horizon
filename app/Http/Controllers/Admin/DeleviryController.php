<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\SendOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleviryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:delivery', ['only' => ['index']]);
        $this->middleware('permission:send requests delivery', ['only' => ['delivery', 'postDelivery']]);
    }

    public function index()
    {
        $delivery = SendOrder::query()->where('admin_id', auth('admin')->user()->id)->where('role', 'delivery')->where('status', '1')->get();
        $requestes = SendOrder::query()->where('admin_id', auth('admin')->user()->id)->where('role', 'delivery')->where('status', '0')->get();
        return view('admin.orders.deleviry.index', compact('delivery', 'requestes'));
    }

    public function delivery()
    {
        try {
            $delivery = Order::query()->where('status', '3')->get();
            $orders = Order::query()->where('status', '2')->get();
            $admins = Admin::query()->where('role_name', '["delivery"]')->get();
            return view('admin.orders.deleviry.delivery', compact('delivery', 'orders', 'admins'));
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function postDelivery(Request $request)
    {
        try {

            $request->validate([
                'order_ids' => 'required',
                'admin_id' => 'required'
            ], [
                'order_ids.required' => 'Please choose at least one order',
                'admin_ids.required' => 'The admin field is required'
            ]);

            foreach ($request->order_ids as $order_id) {
                Order::query()->findOrFail($order_id)->update(['status' => '3']);
                SendOrder::query()->create([
                    'admin_id' => $request->admin_id,
                    'order_id' => $order_id,
                    'role' => 'delivery'
                ]);
            }

            return redirect()->back()->with('success', 'Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }


    public function complete($order_id)
    {
        Order::query()->findOrFail($order_id)->update(['status' => '4']);
        SendOrder::query()->where('order_id', $order_id)->delete();
        return redirect()->back()->with('success', 'Successfully');
    }
}
