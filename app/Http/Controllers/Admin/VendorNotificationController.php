<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorNotification;
use Illuminate\Http\Request;

class VendorNotificationController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.pages.vendor notifications.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        try {

            // return $request;

            $request->validate([
                'message' => 'required|min:3',
            ]);

            if ($request->vendor_id) {
                $vendorNotifications = new VendorNotification();
                $vendorNotifications->title = $request->message;
                $vendorNotifications->vendor_id = $request->vendor_id;
                $vendorNotifications->save();
            } elseif ($request->vendor_ids) {
                $ids = explode(',', $request->vendor_ids);
                foreach ($ids as $id) {
                    $vendorNotifications = new VendorNotification();
                    $vendorNotifications->title = $request->message;
                    $vendorNotifications->vendor_id = $id;
                    $vendorNotifications->save();
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Please Select Vendor']);
            }


            return redirect()->back()->with('success', 'Send Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'message' => 'required|min:3',
                'id' => 'required'
            ]);

            $vendorNotifications = VendorNotification::query()->findOrFail($request->id);
            $vendorNotifications->title = $request->message;
            $vendorNotifications->save();

            return redirect()->back()->with('success', 'Update Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $messages = VendorNotification::query()->where('vendor_id', $id)->get();
            return view('admin.pages.vendor notifications.show', compact('messages'));
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        VendorNotification::destroy($id);
        return redirect()->back()->with('success', 'Delete Successfully');
    }
}
