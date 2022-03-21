<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:superAdmin']);
    }

    public function manageAdmin(){
        return view('admin.PersonMaster.admin-manager');
    }
    public function adminAdd(){
        return view('admin.PersonMaster.admin-add');
    }
    public function adminSave(Request $request){
        $is_user = User::where('email', $request->email)->first();
        if(isset($is_user)){
            return response()->json(['status' => false]);
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        $user->givePermissionTo('superAdmin');

        return response()->json(['status' => true]);
    }
    public function userManage(){
        return view('admin.PersonMaster.user-manager');
    }
    public function userAdd(){
        return view('admin.PersonMaster.user-add');
    }
    public function qualifyManage(){
        return view('admin.PersonMaster.qualify-manager');
    }
    public function userSummary(){
        return view('admin.PersonMaster.user-summary');
    }
}
