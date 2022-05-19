<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Qualify;
use App\Models\Team;
use App\Models\User;
use App\Models\UserQualify;
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
        $data = User::with('office', 'team')->where('role', 'user')->get();
        return view('admin.PersonMaster.user-manager', compact('data'));
    }
    public function userAdd(){
        $office = Office::orderBy('name')->get();
        $team = Team::orderBy('name')->get();
        $officeManager = User::whereNotNull('office_id')->get();
        $qualify = Qualify::orderBy('name')->get();
        return view('admin.PersonMaster.user-add', compact('office', 'team', 'officeManager', 'qualify'));
    }
    public function userEdit($id){
        $user = User::find($id);
        $office = Office::orderBy('name')->get();
        $team = Team::orderBy('name')->get();
        $officeManager = User::whereNotNull('office_id')->get();
        $qualify = Qualify::orderBy('name')->get();
        $user_qualify = UserQualify::where('user_id', $id)->get();
        return view('admin.PersonMaster.user-add', compact('user','office', 'team', 'officeManager', 'qualify', 'user_qualify'));
    }
    public function userSave(Request $request){
        if(isset($request->user_id)){
            $user_id = $request->user_id;
            $user = User::where('id', '!=', $user_id)->where('email', $request->email)->first();
            if(isset($user)){
                return response()->json(['status' => false]);
            }
            $team_id = $request->team_id;
            $team = Team::find($team_id);
            $office_id = $team->office_id;
            $office = Office::find($team->office_id);
            if($request->contract_type == 3){
                if(!empty($team->team_manager_id) && ($user_id != $team->team_manager_id)){
                    return response()->json(['status' => false]);
                }
            }
            else if($request->contract_type == 4){
                if(!empty($office->office_manager_id) && ($user_id != $team->team_manager_id)){
                    return response()->json(['status' => false]);
                }
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'address' => $request->address,
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
                'insurance_cost' => $request->insurance_cost,
                'safe_cost' => $request->safe_cost,
                'loan' => $request->loan,
                'advance_pay' => $request->advance_pay,
            ];
            $users = User::where('id', $user_id)->update($data);

            $qualify = $request->qualify;
            UserQualify::where('user_id', $user_id)->delete();
            if(isset($qualify)){
                foreach ($qualify as $item){
                    UserQualify::create(['user_id' => $users->id, 'qualify_id' => $item]);
                }
            }
        }
        else{
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
            $qualify = $request->qualify;
            if(isset($qualify)){
                foreach ($qualify as $item){
                    UserQualify::create(['user_id' => $users->id, 'qualify_id' => $item]);
                }
            }
        }

        return response()->json(['status' => true]);
    }

    public function qualifyManage(){
        $data = Qualify::all();
        return view('admin.PersonMaster.qualify-manager', compact('data'));
    }
    public function qualifySave(Request $request){
        if(isset($request->id)){
            Qualify::where('id', $request->id)->update(['type_name' => $request->type_name, 'name' => $request->name, 'cost' => $request->cost]);
        }
        else{
            Qualify::create(['type_name' => $request->type_name, 'name' => $request->name, 'cost' => $request->cost]);
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
