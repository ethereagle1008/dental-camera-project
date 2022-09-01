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
        $data = User::whereNull('contract_type')->where('role', 'super')->orWhere('role', 'admin')->get();
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
        $officeManager = User::where('contract_type', 4)->get();
        $qualify = Qualify::orderBy('name')->get();
        return view('admin.PersonMaster.user-add', compact('office', 'team', 'officeManager', 'qualify'));
    }
    public function userEdit($id){
        $user = User::find($id);
        $office = Office::orderBy('name')->get();
        $team = Team::orderBy('name')->get();
        $officeManager = User::where('contract_type', 4)->whereNotNull('office_id')->get();
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
            if(isset($request->password)){
                $data = [
                    'role' => 'user',
                    'name' => $request->name,
                    'furi' => $request->furi,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'birthday' => isset($request->birthday) ? date('Y-m-d', strtotime($request->birthday)) : null,
                    'gender' => $request->gender,
                    'blood' => $request->blood,
                    'address' => $request->address,
                    'emergency_name' => $request->emergency_name,
                    'emergency_number' => $request->emergency_number,
                    'phone' => $request->phone,
                    'contract_type' => $request->contract_type,
                    'contract_value' => $request->contract_value,
                    'move_value' => $request->move_value,
                    'guarantee_day' => $request->guarantee_day,
                    'deal_type' => $request->deal_type,
                    'enter_date' => isset($request->enter_date) ? date('Y-m-d', strtotime($request->enter_date)) : null,
                    'employ_place' => $request->employ_place,
                    'payment_type' => $request->payment_type,
                    'salary_type' => $request->salary_type,
                    'exit_date' => isset($request->exit_date) ? date('Y-m-d', strtotime($request->exit_date)) : null,
                    'receive_type' => $request->receive_type,
                    'vehicle_license' => $request->vehicle_license,
                    'heavy_license' => $request->heavy_license,
                    'dormitory' => $request->dormitory,
                    'helmet' => $request->helmet,
                    'business_phone' => $request->business_phone,
                    'safe_cost' => $request->safe_cost,
                    'insurance_cost' => $request->insurance_cost,
                    'loan' => $request->loan,
                    'advance_pay' => $request->advance_pay,
                    'advance_pay' => $request->advance_pay,
                    'daily_amount' => $request->daily_amount,
                    'overtime_amount' => $request->overtime_amount,
                    'night_amount' => $request->night_amount,
                    'overnight_amount' => $request->overnight_amount,
                    'full_salary' => $request->full_salary,
                ];
            }
            else{
                $data = [
                    'role' => 'user',
                    'name' => $request->name,
                    'furi' => $request->furi,
                    'email' => $request->email,
                    'birthday' => isset($request->birthday) ? date('Y-m-d', strtotime($request->birthday)) : null,
                    'gender' => $request->gender,
                    'blood' => $request->blood,
                    'address' => $request->address,
                    'emergency_name' => $request->emergency_name,
                    'emergency_number' => $request->emergency_number,
                    'phone' => $request->phone,
                    'contract_type' => $request->contract_type,
                    'contract_value' => $request->contract_value,
                    'move_value' => $request->move_value,
                    'guarantee_day' => $request->guarantee_day,
                    'deal_type' => $request->deal_type,
                    'enter_date' => isset($request->enter_date) ? date('Y-m-d', strtotime($request->enter_date)) : null,
                    'employ_place' => $request->employ_place,
                    'payment_type' => $request->payment_type,
                    'salary_type' => $request->salary_type,
                    'exit_date' => isset($request->exit_date) ? date('Y-m-d', strtotime($request->exit_date)) : null,
                    'receive_type' => $request->receive_type,
                    'vehicle_license' => $request->vehicle_license,
                    'heavy_license' => $request->heavy_license,
                    'dormitory' => $request->dormitory,
                    'helmet' => $request->helmet,
                    'business_phone' => $request->business_phone,
                    'safe_cost' => $request->safe_cost,
                    'insurance_cost' => $request->insurance_cost,
                    'loan' => $request->loan,
                    'advance_pay' => $request->advance_pay,
                    'daily_amount' => $request->daily_amount,
                    'overtime_amount' => $request->overtime_amount,
                    'night_amount' => $request->night_amount,
                    'overnight_amount' => $request->overnight_amount,
                    'full_salary' => $request->full_salary,
                ];
            }

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

            $data = [
                'role' => 'user',
                'name' => $request->name,
                'furi' => $request->furi,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birthday' => isset($request->birthday) ? date('Y-m-d', strtotime($request->birthday)) : null,
                'gender' => $request->gender,
                'blood' => $request->blood,
                'address' => $request->address,
                'emergency_name' => $request->emergency_name,
                'emergency_number' => $request->emergency_number,
                'phone' => $request->phone,
                'contract_type' => $request->contract_type,
                'contract_value' => $request->contract_value,
                'move_value' => $request->move_value,
                'guarantee_day' => $request->guarantee_day,
                'deal_type' => $request->deal_type,
                'enter_date' => isset($request->enter_date) ? date('Y-m-d', strtotime($request->enter_date)) : null,
                'employ_place' => $request->employ_place,
                'payment_type' => $request->payment_type,
                'salary_type' => $request->salary_type,
                'exit_date' => isset($request->exit_date) ? date('Y-m-d', strtotime($request->exit_date)) : null,
                'receive_type' => $request->receive_type,
                'vehicle_license' => $request->vehicle_license,
                'heavy_license' => $request->heavy_license,
                'dormitory' => $request->dormitory,
                'helmet' => $request->helmet,
                'business_phone' => $request->business_phone,
                'safe_cost' => $request->safe_cost,
                'insurance_cost' => $request->insurance_cost,
                'loan' => $request->loan,
                'advance_pay' => $request->advance_pay,
                'advance_pay' => $request->advance_pay,
                'daily_amount' => $request->daily_amount,
                'overtime_amount' => $request->overtime_amount,
                'night_amount' => $request->night_amount,
                'overnight_amount' => $request->overnight_amount,
                'full_salary' => $request->full_salary,
            ];
            $users = User::create($data);
            $users->givePermissionTo('user');
            $qualify = $request->qualify;
            if(isset($qualify)){
                foreach ($qualify as $item){
                    UserQualify::create(['user_id' => $users->id, 'qualify_id' => $item]);
                }
            }
        }

        return response()->json(['status' => true]);
    }

    public function userDelete(Request $request){
//        $user_id = $request->user_id;
//        if(Auth::user()->id == $user_id){
//            return response()->json(['status' => false]);
//        }
//        User::find($user_id)->delete();
//        return response()->json(['status' => true]);
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

    public function userDeleteInfo(Request  $request){
        $user_id = $request->user_id;
        User::delete($user_id);
        return response()->json(['status' => true]);
    }

    public function businessManager(){
        $data = User::with('office', 'team', 'place')->where('role', 'user')->where('deal_type', 2)->get();
        return view('admin.PersonMaster.business-manager', compact('data'));
    }
    public function employeeManager(){
        $data = User::with('office', 'team', 'place')->where('role', 'user')->where('deal_type', 1)->get();
        return view('admin.PersonMaster.employee-manager', compact('data'));
    }
}
