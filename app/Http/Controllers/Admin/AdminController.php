<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:admins', ['only' => ['index']]);
        $this->middleware('permission:create admins', ['only' => ['create','store']]);
        $this->middleware('permission:update admins', ['only' => ['edit','update']]);
        $this->middleware('permission:delete admins', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Admin::orderBy('id', 'DESC')->paginate(5);
        return view('admin.admins.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $data = $request->except('token', 'password', 'roles');
        $data['password'] = Hash::make($request->password);
        $data['role_name'] = $request->roles;

        $user = Admin::create($data);
        $user->assignRole($request->input('roles'));
        return redirect()->route('admin.admins.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::query()->findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $adminRole = $admin->roles->pluck('name', 'name')->all();
        return view('admin.admins.edit', compact('admin', 'roles', 'adminRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id,
//            'roles' => 'required',
            'status' => 'required'
        ]);


        $data = $request->except('_token', 'password', 'roles', '_method');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $admin = Admin::query()->findOrFail($id);
        $admin->update($data);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $admin->assignRole($request->input('roles'));

        return redirect()->route('admin.admins.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.admins.index')
            ->with('success', 'User deleted successfully');
    }
}
