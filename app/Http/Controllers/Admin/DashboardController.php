<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\Product;
use App\Models\Vendor;
use App\Notifications\OrderNotivication;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{
    public function index() {


        $admins = Admin::all();

        $vendor_ids = Vendor::query()->pluck('id');

        foreach ($vendor_ids as $vendor_id) {

            $orderNotifications = OrderNotification::query()->where('vendor_id', $vendor_id)->orderBy('date', 'asc')->first();

            if (!$orderNotifications) {
                continue;
            }

            $fineStamp = $orderNotifications->date;
            $d = new DateTime($fineStamp);
            $d->add(new DateInterval('P5D'));
            $date=$d->format('Y-m-d ').PHP_EOL;
            $finishDate = substr($date, 0, -2);

            if ($finishDate <= date('Y-m-d')) {
                Notification::send($admins, new OrderNotivication($orderNotifications->vendor_id));
                $orderNotifications->delete();
            }

        }

        return view('admin.index');
    }

    public function notifications() {
        return view('admin.notifications.index');
    }

    public function readNotifications($id) {
        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        return back();
    }

    public function markAllAsRead() {
        $admin = Admin::query()->findOrFail(auth('admin')->user()->id);


        foreach ($admin->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return back();

    }

    public function deleteNotification($id) {
        DB::table('notifications')->where('id', $id)->delete();
        return back();
    }

}
