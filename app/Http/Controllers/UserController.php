<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\UserAdvance;
use App\Models\UserShift;
use App\Models\Vehicle;
use App\Models\VehicleReport;
use App\Models\WorkReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function dashboard(){
        $shift = UserShift::where('user_id', Auth::user()->id)->where('shift_date', date('Y-m-d'))->first();
        $sites = Site::where('status', 1)->get();
        return view('dashboard', compact('shift', 'sites'));
    }
    public function payRequest(){
        $limit = 10000;
        $is_exist = UserAdvance::where('user_id', Auth::user()->id)->where('status', 0)->first();
        return view('user.pay-request', compact('limit', 'is_exist'));
    }
    public function payRequestPost(Request $request){
        $is_exist = UserAdvance::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(isset($is_exist)){
            return response()->json(['status' => false]);
        }
        UserAdvance::create(['user_id' => Auth::user()->id, 'payment' => $request->payment]);
        return response()->json(['status' => true]);
    }

    public function dailyReport(){
        $sites = Site::where('status', 1)->get();
        return view('user.daily-report', compact('sites'));
    }
    public function dailyReportPost(Request $request){
        $report = WorkReport::where('site_id', $request->site_id)->where('report_date', date('Y-m-d'))->first();
        if(isset($report)){
            WorkReport::where('id', $report->id)->update(['user_id' => Auth::user()->id, 'report' => $request->report]);
        }
        else{
            WorkReport::create(['user_id' => Auth::user()->id, 'report' => $request->report, 'site_id' => $request->site_id, 'report_date' => date('Y-m-d')]);
        }
        return response()->json(['status' => true]);
    }

    public function vehicleReport(){
        $sites = Site::where('status', 1)->get();
        $vehicles = Vehicle::all();
        return view('user.vehicle-report', compact('sites', 'vehicles'));
    }
    public function vehicleReportPost(Request $request){
        $site_id = $request->site_id;
        $vehicle_id = $request->vehicle_id;
        $report = VehicleReport::where('site_id', $site_id)->where('vehicle_id', $vehicle_id)->where('report_date', date('Y-m-d'))->first();
        $data = [
            'site_id' => $site_id,
            'vehicle_id' => $vehicle_id,
            'report_type' => $request->report_type,
            'report_date' => date('Y-m-d'),
            'etc_value' => $request->etc_value,
            'etc_apply' => $request->etc_apply,
            'oil_value' => $request->oil_value,
            'oil_apply' => $request->oil_apply,
            'parking_value' => $request->parking_value,
            'parking_apply' => $request->parking_apply,
            'other_value' => $request->other_value,
            'other_apply' => $request->other_apply
        ];
        if(isset($report)){
            VehicleReport::where('id', $report->id)->update($data);
        }
        else{
            VehicleReport::create($data);
        }
        return response()->json(['status' => true]);
    }

    public function shiftPost(Request $request){

        if($request->type == 'arrive'){
            $shift = UserShift::where('user_id', Auth::user()->id)->where('shift_date', date('Y-m-d'))->first();
            if(isset($shift)){
                return response()->json(['status' => false]);
            }
            $data = [
                'user_id' => Auth::user()->id,
                'start_time' => date('Y-m-d H:i:s'),
                'start_place' => $request->place,
                'site_id' => $request->site_id,
                'shift_date' => date('Y-m-d')
            ];
            UserShift::create($data);
        }
        else{
            $shift = UserShift::where('id', $request->site_id)->first();
            if(!isset($shift)){
                return response()->json(['status' => false]);
            }
            $data = [
                'end_time' => date('Y-m-d H:i:s'),
                'end_place' => $request->place,
            ];
            UserShift::where('id', $shift->id)->update($data);
        }

        return response()->json(['status' => true]);
    }
    public function leave(Request $request){
        return response()->json(['status' => true]);
    }
}
