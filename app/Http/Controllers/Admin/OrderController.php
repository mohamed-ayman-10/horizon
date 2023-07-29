<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\SendOrder;
use App\Models\User;
use App\Notifications\SendOrderNotivication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:orders', ['only' => ['index']]);
        $this->middleware('permission:order show user', ['only' => ['showUser']]);
        $this->middleware('permission:order show vendor', ['only' => ['showVendor']]);
        $this->middleware('permission:order show product', ['only' => ['showProduct']]);
        $this->middleware('permission:receive', ['only' => ['receive', 'postReceive']]);
    }

    public function index()
    {
        $orders = Order::all();
        $sendOrders = SendOrder::query()->where('admin_id', auth('admin')->user()->id)->orderBy('status', 'asc')->get();
        $sendOrdersIds = SendOrder::query()->pluck('admin_id');
        return view('admin.orders.index', compact('orders', 'sendOrders', 'sendOrdersIds'));
    }

    public function showUser($id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return view('admin.orders.user', compact('user'));
    }

    public function showVendor($id)
    {
        $vendor = User::query()->where('id', $id)->firstOrFail();
        return view('admin.orders.vendor', compact('vendor'));
    }

    public function showProduct($id)
    {
        $product = Product::query()->where('id', $id)->firstOrFail();
        return view('admin.orders.product', compact('product'));
    }

    public function more($id)
    {
        $order = Order::query()->findOrFail($id);
        return view('admin.orders.more', compact('order'));
    }

    public function sendOrder(Request $request)
    {
        try {
            $request->validate([
                'order_id' => 'required',
                'admin_id' => 'required',
            ]);

            SendOrder::query()->updateOrCreate(
                [
                    'order_id' => $request->order_id,
                ],
                [
                    'order_id' => $request->order_id,
                    'admin_id' => $request->admin_id,
                ]
            );


            return redirect()->back()->with('success', 'Send Successfully!');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function statusSendOrder(Request $request)
    {
        try {

            $admin = Admin::query()->where('email', 'admin@admin.com')->get();

            $sendOrder = SendOrder::query()
                ->where('admin_id', auth('admin')->user()->id)
                ->where('order_id', $request->order_id)
                ->firstOrFail();

            //            return $sendOrder;

            if ($request->status == 1) {
                $sendOrder->update([
                    'status' => '1'
                ]);
                Order::query()->where('id', $request->order_id)->update(['status' => '1']);

                Notification::send($admin, new SendOrderNotivication(auth('admin')->user()->id, 1));

                return redirect()->back()->with('success', 'The request has been successfully accepted!');
            } elseif ($request->status == 0) {
                Order::query()->where('id', $request->order_id)->update(['status' => '0']);
                $sendOrder->delete();

                Notification::send($admin, new SendOrderNotivication(auth('admin')->user()->id, 0));

                return redirect()->back()->with('success', 'The request was successfully rejected!');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
