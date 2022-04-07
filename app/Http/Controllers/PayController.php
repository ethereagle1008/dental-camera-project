<?php

namespace App\Http\Controllers;

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
    public function payRequestTable(){
        return view('admin.PayMaster.pay-request-table');
    }
    public function paySumManage(){
        return view('admin.PayMaster.pay-sum-manager');
    }
}
