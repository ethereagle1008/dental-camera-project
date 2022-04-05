<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Qualify;
use App\Models\Team;
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
        $office = Office::orderBy('name')->get();
        $team = Team::orderBy('name')->get();
        $officeManager = User::whereNotNull('office_id')->get();
        return view('admin.PersonMaster.user-add', compact('office', 'team', 'officeManager'));
    }
    public function userSave(Request $request){
        $user = User::where('email', $request->email)->first();
        if(isset($user)){
            return response()->json(['status' => false]);
        }
        $team_id = $request->team_id;
        $team = Team::find($team_id);
        $office_id = $team->office_id;
        $office = Office::find($team->office_id);
        if($request->contract_type == 3){
            if(!empty($team->team_manager_id)){
                return response()->json(['status' => false]);
            }
        }
        else if($request->contract_type == 4){
            if(!empty($office->office_manager_id)){
                return response()->json(['status' => false]);
            }
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'furi' => $request->furi,
            'gender' => $request->gender,
            'blood' => $request->blood,
            'birthday' => isset($request->birthday) ? date('Y-m-d', strtotime($request->birthday)) : null,
            'phone' => $request->phone,
            'emergency_name' => $request->emergency_name,
            'emergency_number' => $request->emergency_number,
            'contract_type' => $request->contract_type,
            'director_id' => $request->director_id,
            'office_id' => $office_id,
            'team_id' => $team_id,
            'dormitory' => $request->dormitory,
            'cloth' => $request->cloth,
            'business_phone' => $request->business_phone,
            'insurance' => $request->insurance,
            'receive_type' => $request->receive_type,
        ];
        $users = User::create($data);
        $users->givePermissionTo('user');

        if($request->contract_type == 3){
            Team::where('id', $team_id)->update(['team_manager_id' => $users->id]);
        }
        else if($request->contract_type == 4){
            Office::where('id', $office_id)->update(['office_manager_id' => $users->id]);
        }

        return response()->json(['status' => true]);
    }

    public function qualifyManage(){
        $data = Qualify::all();
        return view('admin.PersonMaster.qualify-manager', compact('data'));
    }
    public function qualifySave(Request $request){
        if(isset($request->id)){
            Qualify::where('id', $request->id)->update(['type_name' => $request->type_name, 'name' => $request->name]);
        }
        else{
            Qualify::create(['type_name' => $request->type_name, 'name' => $request->name]);
        }
        return response()->json(['status' => true]);
    }
    public function qualifyDelete(Request $request){
        Qualify::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }


    public function userSummary(){
        $data = User::where('role', 'user')->get();
        return view('admin.PersonMaster.user-summary', compact('data'));
    }
}
