<?php

namespace App\Http\Controllers;

use App\Models\UserAdvance;
use Illuminate\Http\Request;

class PayController extends Controller
{
    //
    public function payTotalManage(){
        return view('admin.PayMaster.pay-total-manager');
    }
    public function payRequestManage(){
        return view('admin.PayMaster.pay-request-manager');
    }
    public function payRequestTable(Request $request){
        $user_name = $request->user_name;
        if(isset($user_name)){
            $data = UserAdvance::with('user')->whereHas('user', function ($query) use ($user_name){
                $query->where('name', 'like' , '%' . $user_name . '%');
            })->orderBy('updated_at', 'desc')->get();
        }
        else{
            $data = UserAdvance::with('user')->orderBy('updated_at', 'desc')->get();
        }
        return view('admin.PayMaster.pay-request-table', compact('data'));
    }
    public function payRequestStatus(Request $request){
        $id = $request->id;
        if($request->status == 1){
            UserAdvance::where('id', $id)->update(['status' => $request->status]);
        }
        else{
            UserAdvance::where('id', $id)->delete();
        }
        return response()->json(['status' => true]);
    }
    public function paySumManage(){
        return view('admin.PayMaster.pay-sum-manager');
    }
}
