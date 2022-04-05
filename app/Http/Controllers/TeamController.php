<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    public function teamManage(){
        $data = Team::with('teamManager', 'office')->get();
        $users = User::where('role', 'user')->where('contract_type', 3)->orwhere('contract_type', 4)->get();
        $office = Office::orderBy('name','asc')->get();
        return view('admin.TeamMaster.team-manager', compact('data', 'users', 'office'));
    }
    public function teamSave(Request $request){
        if(isset($request->team_manager_id)){
            $user = User::find($request->team_manager_id);
            if(isset($request->id)){
                if(!isset($request->team_id)){
                    Team::where('id', $request->id)->update(['name' => $request->name, 'team_manager_id' => $request->team_manager_id, 'office_id' => $request->office_id]);
                }
                else if($user->offic_id == $request->id){
                    Team::where('id', $request->id)->update(['name' => $request->name, 'team_manager_id' => $request->team_manager_id, 'office_id' => $request->office_id]);
                }
                else{
                    return response()->json(['status' => false]);
                }
            }
            else{
                if(isset($user->team_id)){
                    return response()->json(['status' => false]);
                }
                Team::create(['name' => $request->name, 'team_manager_id' => $request->team_manager_id, 'office_id' => $request->office_id]);
            }
        }
        else{
            if(isset($request->id)){
                if(!isset($request->team_id)){
                    Team::where('id', $request->id)->update(['name' => $request->name, 'office_id' => $request->office_id]);
                }
                else{
                    return response()->json(['status' => false]);
                }
            }
            else{
                Team::create(['name' => $request->name, 'office_id' => $request->office_id]);
            }
        }
        return response()->json(['status' => true]);
    }

    public function teameDelete(Request $request){
        Team::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }
    public function teamAdd(){
        return view('admin.TeamMaster.team-add');
    }
}
