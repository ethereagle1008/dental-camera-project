<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use App\Models\UserShift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    //
    public function borrowManager(){
        $users = User::where('role', 'user')->get();
        $data = Borrow::with('user')->orderBy('created_at', 'desc')->get()->all();
        return view('admin.BorrowMaster.borrow-manager', compact('users', 'data'));
    }
    public function borrowSave(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'repay_type' => $request->repay_type,
            'repay_amount' => $request->repay_amount,
            'start_date' => isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null,
        ];

        if(isset($request->id)){
            Borrow::where('id', $request->id)->update($data);
        }
        else{
            Borrow::create($data);
        }
        return response()->json(['status' => true]);
    }
    public function borrowDelete(Request $request){
        Borrow::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }
    public function borrowBalanceManager(){
        $user_data = DB::table('borrows')  //＄groupsは変数にいれてるだけ
            ->leftJoin('users', 'borrows.user_id', '=', 'users.id')
            ->select('borrows.user_id', DB::raw("SUM(borrows.amount) as qt"))
            ->groupBy('borrows.user_id')
            ->get()->toArray();
        $now = date('Y-m-d');
        foreach ($user_data as $datum){
            $user_id = $datum->user_id;
            $pay_data = Borrow::where('user_id', $user_id)->get();
            $sum_repay = 0;
            foreach ($pay_data as $pay){
                $start_date = $pay->start_date;
                $repay_type = $pay->repay_type;
                $repay_amount = $pay->repay_amount;
                if($repay_type == 1){
                    $cnt_shift_total = UserShift::where('user_id', $user_id)->where('shift_date', '>=', $start_date)->where('shift_date', '<', $now)->get()->count();
                    $pay->paid = $cnt_shift_total * $repay_amount > $pay->amount ? $pay->amount : $cnt_shift_total * $repay_amount > $pay->amount;
                    $pay->remain = $pay->amount - $pay->paid;
                }
                else if($repay_type == 2){
                    try {
                        $start = new DateTime($start_date);
                        $end = new DateTime();
                        $days = $start->diff($end, true)->days;
                        $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
                        $pay->paid = $sundays * $repay_amount > $pay->amount ? $pay->amount : $sundays * $repay_amount;
                        $pay->remain = $pay->amount - $pay->paid;
                    } catch (\Exception $e) {
                    }
                }
                else{
                    $date1 = '2000-01-25';
                    $date2 = '2010-02-20';

                    $ts1 = strtotime($start_date);
                    $ts2 = strtotime(date('Y-m-d'));

                    $year1 = date('Y', $ts1);
                    $year2 = date('Y', $ts2);

                    $month1 = date('m', $ts1);
                    $month2 = date('m', $ts2);

                    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                    $pay->paid = $diff * $repay_amount > $pay->amount ? $pay->amount : $diff * $repay_amount;
                    $pay->remain = $pay->amount - $pay->paid;
                }
                $sum_repay += $pay->paid;
            }
            $datum->paid = $sum_repay;
            $datum->remain = $datum->qt - $sum_repay;
            $datum->name = User::find($user_id)->name;
            $datum->pay_data = $pay_data;
        }
//        print_r($user_data);
//        die();
        return view('admin.BorrowMaster.borrow-balance-manager', compact('user_data'));
    }
}
