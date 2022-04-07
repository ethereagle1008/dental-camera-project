<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\UserAdvance;
use App\Models\UserShift;
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
        return view('user.pay-request', compact('limit'));
    }
    public function payRequestPost(Request $request){
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
