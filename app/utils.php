<?php

use Illuminate\Support\Facades\Mail;
function sendResetEmail($verify_code, $email){
    $details = array(
        'verify_code'=> $verify_code
    );
    Mail::to($email)->send(new \App\Mail\ResetPasswordEmail($details));
}
function sendTempEmail($password, $email){
    $details = array(
        'password'=> $password,
        'email' => $email
    );
    Mail::to($email)->send(new \App\Mail\TempPasswordEmail($details));
}
function sendCreditCodeEmail($password, $email){
    $details = array(
        'credit_code'=> $password,
        'email' => $email
    );
    Mail::to($email)->send(new \App\Mail\SendCreditCodeEmail($details));
}
function sendCodeEmail($verify_code, $email){
    $details = array(
        'verify_code'=> $verify_code,
    );
    Mail::to($email)->send(new \App\Mail\SendCodeEmail($details));
}
function sendCashEmail($details, $email){

    Mail::to($email)->send(new \App\Mail\CashSendEmail($details));
}

function contractType($contract_type){
    switch ($contract_type) {
        case 4:
            return "所長";
        case 3:
            return "班長";
        case 1:
            return "一般";
        case 5:
            return "その他";
    }
    return "";
}
function dayWeek($day_week){
    switch ($day_week) {
        case 1:
            return "月";
        case 2:
            return "火";
        case 3:
            return "水";
        case 4:
            return "木";
        case 5:
            return "金";
        case 6:
            return "土";
        case 7:
            return "日";
    }
    return "";
}
function calculatePriceByRole($cnt, $contract_type, $over){
    $per_day_normal_price = 0;
    $per_day_night_price = 0;
    $per_time_over_price = 2344;
    $per_day_safe_price = 0;

    switch ($contract_type) {
        case 1:
            $per_day_normal_price = 12000;
            $per_day_night_price = 18000;
            $per_day_safe_price = 360;
            break;
        case 2:
            $per_day_normal_price = 13500;
            $per_day_night_price = 20250;
            $per_day_safe_price = 405;
            break;
        case 3:
            $per_day_normal_price = 15000;
            $per_day_night_price = 22500;
            $per_day_safe_price = 450;
            break;
        case 4:
            $per_day_normal_price = 15000;
            $per_day_night_price = 22500;
            $per_day_safe_price = 450;
            break;
        case 5:
            $per_day_normal_price = 18000;
            $per_day_night_price = 27000;
            $per_day_safe_price = 540;
            break;
    }

    if($over == 1){
        return $cnt * $per_day_normal_price;
    }
    else if($over == 2){
        return $cnt * $per_day_night_price;
    }
    else if($over == 3){
        return $cnt * $per_time_over_price;
    }
    else{
        return $cnt * $per_day_safe_price;
    }
}
function calculatePriceByType($cnt, $type){
    $price = 0;
    switch ($type) {
        case 'insurance':
            $price = 1000;
            break;
        case 'self-insurance':
            $price = 360;
            break;
        case 'cloth':
            $price = 180;
            break;
        case 'helmet':
            $price = 70;
            break;
        case 'dormitory':
            $price = 3750;
            break;
        case 'phone':
            $price = 200;
            break;
    }
    return $cnt * $price;
}

function substrwords($text, $maxchar, $end='...') {
    if (mb_strlen($text) > $maxchar) {
        $len = mb_strlen($text);
        $output = mb_substr($text, 0, $maxchar, 'utf-8');

        $output .= $end;
    }
    else {
        $output = $text;
    }
    return $output;
}

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateJsessionString($length = 22) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

