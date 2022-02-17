<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function payRequest(){
        return view('user.pay-request');
    }
    public function payRequestPost(){
        return response()->json(['status' => true]);
    }
    public function dailyReport(){
        return view('user.daily-report');
    }
    public function dailyReportPost(Request $request){
        return response()->json(['status' => true]);
    }
    public function arrive(Request $request){
        return response()->json(['status' => true]);
    }
    public function leave(Request $request){
        return response()->json(['status' => true]);
    }
}
