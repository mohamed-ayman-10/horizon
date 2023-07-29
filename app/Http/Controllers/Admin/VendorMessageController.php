<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorMessage;
use App\Http\Controllers\Controller;

class VendorMessageController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.pages.vendor Messages.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        try {

            // return $request;

            $request->validate([
                'message' => 'required|min:3',
            ]);

            if ($request->vendor_id) {
                $VendorMessages = new VendorMessage();
                $VendorMessages->title = $request->message;
                $VendorMessages->vendor_id = $request->vendor_id;
                $VendorMessages->save();
            } elseif ($request->vendor_ids) {
                $ids = explode(',', $request->vendor_ids);
                foreach ($ids as $id) {
                    if ($id == 'null') {
                        continue;
                    }
                    $VendorMessages = new VendorMessage();
                    $VendorMessages->title = $request->message;
                    $VendorMessages->vendor_id = $id;
                    $VendorMessages->save();
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

            $VendorMessages = VendorMessage::query()->findOrFail($request->id);
            $VendorMessages->title = $request->message;
            $VendorMessages->save();

            return redirect()->back()->with('success', 'Update Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $messages = VendorMessage::query()->where('vendor_id', $id)->get();
            return view('admin.pages.vendor Messages.show', compact('messages'));
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        VendorMessage::destroy($id);
        return redirect()->back()->with('success', 'Delete Successfully');
    }
}
