<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function vehicleManager(){
        $users = User::where('role', 'user')->get();
        $data = Vehicle::with('user')->get()->all();
        return view('admin.VehicleMaster.vehicle-manager', compact('users', 'data'));
    }

    public function vehicleSave(Request $request){
        if($request->owner_type == 1){
            $data = [
                'owner_type' => $request->owner_type,
                'number' => $request->number,
                'type' => $request->type,
                'manager' => $request->manager
            ];
        }
        else{
            $data = [
                'owner_type' => $request->owner_type,
                'user_id' => $request->user_id,
                'number' => $request->number,
                'type' => $request->type,
                'manager' => $request->manager
            ];
        }
        if(isset($request->id)){
            Vehicle::where('id', $request->id)->update($data);
        }
        else{
            Vehicle::create($data);
        }
        return response()->json(['status' => true]);
    }
    public function vehicleDelete(Request $request){
        Vehicle::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }
}
