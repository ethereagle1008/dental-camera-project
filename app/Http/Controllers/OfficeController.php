<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    //
    public function officeManage(){
        $data = Office::with('officeManager')->get();
        $users = User::where('role', 'user')->where('contract_type', 4)->get();
        return view('admin.OfficeMaster.office-manager', compact('data', 'users'));
    }
    public function officeSave(Request $request){
        if(isset($request->office_manager_id)){
            $user = User::find($request->office_manager_id);
            if(isset($request->id)){
                if(!isset($request->office_id)){
                    Office::where('id', $request->id)->update(['name' => $request->name, 'office_manager_id' => $request->office_manager_id]);
                }
                else if($user->offic_id == $request->id){
                    Office::where('id', $request->id)->update(['name' => $request->name, 'office_manager_id' => $request->office_manager_id]);
                }
                else{
                    return response()->json(['status' => false]);
                }
            }
            else{
                if(isset($user->office_id)){
                    return response()->json(['status' => false]);
                }
                Office::create(['name' => $request->name, 'office_manager_id' => $request->office_manager_id]);
            }
        }
        else{
            if(isset($request->id)){
                if(!isset($request->office_id)){
                    Office::where('id', $request->id)->update(['name' => $request->name]);
                }
                else{
                    return response()->json(['status' => false]);
                }
            }
            else{
                Office::create(['name' => $request->name]);
            }
        }
        return response()->json(['status' => true]);
    }

    public function officeeDelete(Request $request){
        Office::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }

    public function officeAdd(){
        return view('admin.OfficeMaster.office-add');
    }
}
