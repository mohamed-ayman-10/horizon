<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class  UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:users', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['store']]);
        $this->middleware('permission:update user', ['only' => ['update']]);
        $this->middleware('permission:delete user', ['only' => ['delete_user']]);
    }

    public function index()
    {
        $user = User::all();
        return view('admin/user/index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6'
        ]);
        if ($request->password) {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'update Successfully');
        }else{
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return back()->with('success', 'update Successfully');
        }

    }

    public function delete_user($id){
        User::destroy($id);
       return back()->with('success', 'Deleted Successfully');

   }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'phone' => 'required',
            'password' => 'required|string|min:6'
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('success', 'Create Successfully');
    }

}
