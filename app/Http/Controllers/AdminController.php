<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:superAdmin']);
    }

    public function manageAdmin(){
        $data = User::where('role', 'super')->orWhere('role', 'admin')->get();
        return view('admin.PersonMaster.admin-manager', compact('data'));
    }
    public function adminAdd(){
        return view('admin.PersonMaster.admin-add');
    }
    public function adminSave(Request $request){
        if(isset($request->user_id)){
            $is_user = User::where('email', $request->email)->where('id', '!=', $request->user_id)->first();
            if(isset($is_user)){
                return response()->json(['status' => false]);
            }
            User::find($request->user_id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['status' => true]);
        }
        else{
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

    }
    public function adminEdit($id){
        $user = User::find($id);
        return view('admin.PersonMaster.admin-add', compact('user'));
    }
    public function adminDelete(Request $request){
        $user_id = $request->user_id;
        if(Auth::user()->id == $user_id){
            return response()->json(['status' => false]);
        }
        User::find($user_id)->delete();
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
