<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    //
    public function travelManager(){
        $users = User::where('role', 'user')->get();
        $sites = Site::all();
        $data = Travel::with('user', 'site')->orderBy('created_at', 'desc')->get()->all();
        return view('admin.TravelMaster.travel-manager', compact('users', 'data', 'sites'));
    }

    public function travelSave(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'site_id' => $request->site_id,
            'start_date' => isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null,
            'end_date' => isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null
        ];

        if(isset($request->id)){
            Travel::where('id', $request->id)->update($data);
        }
        else{
            Travel::create($data);
        }
        return response()->json(['status' => true]);
    }
    public function travelDelete(Request $request){
        Travel::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }
}
