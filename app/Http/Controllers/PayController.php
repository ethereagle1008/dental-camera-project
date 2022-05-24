<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAdvance;
use App\Models\UserShift;
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

    public function paySumTable(Request $request){
        $year = $request->year;
        $month = $request->month;
        $next = $month + 1;
        $start_time = date('Y-m-01', strtotime($year.'-'.$month));
        $end_time = date('Y-m-01', strtotime($year.'-'.$next));
        $users = User::where('role', 'user')->get();
        $data = [];
        foreach($users as $user){
            $tmp = array();
            $tmp['id'] = $user->id;
            $tmp['name'] = $user->name;
            $tmp['phone'] = $user->phone;
            $cnt_shift_normal = UserShift::where('user_id', $user->id)->where('over', 1)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
            $cnt_shift_night = UserShift::where('user_id', $user->id)->where('over', 2)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
            $shifts_over = UserShift::where('user_id', $user->id)->where('over_time', '!=', 0)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get();
            $tmp['price_normal'] = calculatePriceByRole($cnt_shift_normal, $user->contract_type, 1);
            $tmp['price_night'] = calculatePriceByRole($cnt_shift_night, $user->contract_type, 2);
            $cnt_shift_total = UserShift::where('user_id', $user->id)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
            $price_over = 0;
            foreach ($shifts_over as $shift){
                $price_over = $price_over + calculatePriceByRole($shift->over_time, $user->contract_type, 3);
            }
            $tmp['price_over'] = $price_over;
            $tmp['sub_staff'] = 0;
            $tmp['sub_price'] = 0;
            $tmp['direct_staff'] = 0;
            $tmp['direct_price'] = 0;
            if($user->contract_type == 4){
                $team_id = $user->team_id;
                $team_staffs = User::where('team_id', $team_id)->get();
                foreach ($team_staffs as $staff){
                    if($staff->id != $user->id){
                        $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                        if($cnt_shift_staff >= 20){
                            $tmp['sub_staff'] = $tmp['sub_staff'] + 1;
                        }
                    }
                }
                if($tmp['sub_staff'] > 3){
                    $tmp['sub_price'] = $tmp['sub_staff'] * 7000;
                }
                else{
                    $tmp['sub_staff'] = 0;
                }
                $direct_staffs = User::where('director_id', $user->id)->get();
                foreach ($direct_staffs as $staff){
                    $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                    if($cnt_shift_staff >= 20){
                        $tmp['direct_staff'] = $tmp['direct_staff'] + 1;
                    }
                }
                if($tmp['direct_staff'] > 3){
                    $tmp['direct_price'] = $tmp['direct_staff'] * 3000;
                }
                else{
                    $tmp['direct_staff'] = 0;
                }
            }
            $tmp['a_price'] = $tmp['price_normal'] + $tmp['price_night'] + $tmp['sub_price'] + $tmp['direct_price'] + $price_over;

            $tmp['insurance'] = 0;
            if($user->insurance == 1){
                $tmp['insurance'] = calculatePriceByType(1, 'insurance');
            }
            $tmp['self_insurance'] = calculatePriceByType($cnt_shift_total, 'self-insurance');
            $tmp['safe_cost'] = calculatePriceByRole($cnt_shift_total, $user->contract_type, 'safe-cost');
            $tmp['cloth'] = 0;
            if($user->cloth == 1){
                $tmp['cloth'] = calculatePriceByType($cnt_shift_total, 'cloth');
            }
            $tmp['helmet'] = calculatePriceByType($cnt_shift_total, 'helmet');
            $tmp['dormitory'] = 0;
            if($user->dormitory == 1){
                $tmp['dormitory'] = calculatePriceByType($cnt_shift_total, 'dormitory');
            }
            $tmp['business_phone'] = 0;
            if($user->business_phone == 1){
                $tmp['business_phone'] = calculatePriceByType($cnt_shift_total, 'phone');
            }
            $tmp['pre_pay'] = 0;
            $history = UserAdvance::where('user_id', $user->id)->where('status', 1)->get();
            foreach ($history as $item){
                $tmp['pre_pay'] = $tmp['pre_pay'] + $item->payment;
            }

            $tmp['pring'] = 0;
            if($user->receive_type == 1){
                $tmp['pring'] = 55;
            }
            $tmp['b_price'] = $tmp['insurance'] + $tmp['self_insurance'] + $tmp['safe_cost'] + $tmp['cloth'] + $tmp['helmet'] + $tmp['dormitory'] + $tmp['business_phone'] + $tmp['pre_pay'] + $tmp['pring'];
            array_push($data, $tmp);
        }
        return view('admin.PayMaster.pay-sum-table', compact('data'));
    }

    public function payPersonTable(Request $request){
        $year = $request->year;
        $month = $request->month;
        $next = $month + 1;
        $start_time = date('Y-m-01', strtotime($year.'-'.$month));
        $end_time = date('Y-m-01', strtotime($year.'-'.$next));
        $user = User::find($request->user_id);
        $tmp = array();
        $tmp['id'] = $user->id;
        $tmp['name'] = $user->name;
        $tmp['phone'] = $user->phone;
        $tmp['contract_type'] = $user->contract_type;
        $tmp['month'] = $year.'.'.$month;

        $tmp['pre_pay'] = 0;
        $history = UserAdvance::where('user_id', $user->id)->where('status', 1)->get();
        foreach ($history as $item){
            $tmp['pre_pay'] = $tmp['pre_pay'] + $item->payment;
        }
        $tmp['history'] = $history;

        return view('admin.PayMaster.pay-sum-person', compact('tmp'));
    }

    public function paySumPersonal(){
        $history = UserAdvance::with('user')->orderBy('user_id', 'asc')->get()->groupBy(function($data) {
            return $data->user_id;
        });
        $total = 0;
        foreach($history as $item){
            foreach($item as $i => $it){
                $total = $total + $it->payment;
            }
        }
        return view('admin.PayMaster.pay-sum-personal', compact('history', 'total'));
    }
    public function paySumMonth(){
        $history = UserAdvance::with('user')->orderBy('updated_at', 'asc')->get()->groupBy(function($data) {
            return $data->updated_at->format('Y-m-d');
        });
        $total = 0;
        foreach($history as $item){
            foreach($item as $i => $it){
                $total = $total + $it->payment;
            }
        }

        return view('admin.PayMaster.pay-sum-month', compact('history', 'total'));
    }

}
