<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\SendOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceiveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:receive', ['only' => ['index']]);
        $this->middleware('permission:send requests receive', ['only' => ['receive', 'postReceive']]);
    }

    public function index()
    {
        $receive = SendOrder::query()->where('admin_id', auth('admin')->user()->id)->where('role', 'receive')->where('status', '1')->get();
        $requestes = SendOrder::query()->where('admin_id', auth('admin')->user()->id)->where('role', 'receive')->where('status', '0')->get();
        return view('admin.orders.receive.index', compact('receive', 'requestes'));
    }

    public function receive()
    {
        $receive = Order::query()->where('status', '1')->get();
        $orders = Order::query()->where('status', '0')->get();
        $admins = Admin::query()->where('role_name', '["receive"]')->get();
        return view('admin.orders.receive.receive', compact('receive', 'orders', 'admins'));
    }

    public function postReceive(Request $request)
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
                Order::query()->findOrFail($order_id)->update(['status' => '1']);
                SendOrder::query()->create([
                    'admin_id' => $request->admin_id,
                    'order_id' => $order_id,
                    'role' => 'receive'
                ]);
            }

            return redirect()->back()->with('success', 'Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function complete($order_id)
    {
        Order::query()->findOrFail($order_id)->update(['status' => '2']);
        SendOrder::query()->where('order_id', $order_id)->delete();
        return redirect()->back()->with('success', 'Successfully');
    }
}
