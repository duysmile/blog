<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\UpdateUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('status');
        return $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getUsers();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        User::saveUser($request);
        return redirect("admin/users")->with("success", "Create user successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where([
            'id' => $id,
            'verify' => true,
        ])->first();
        $roles = Role::all();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $this->validate($request, [
            'email' => 'unique:users,email,'. $id .',id',
        ]);
        User::updateUser($id, $request);
        return redirect("admin/users")->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect("admin/users")->with('success', 'Delete successfully!');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.users.profile', ['user' => $user]);
    }
    public function updateProfile(UpdateProfile $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'email' => 'unique:users,email,'. $id .',id',
        ]);
        if(!User::updateProfile($id, $request)){
            return redirect("admin/profile/")->with('error', 'Password confirmation not incorrect.');
        }
        return redirect("admin/")->with('success', 'Update successfully!');
    }
}
