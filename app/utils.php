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
        case 1:
            return "所長";
        case 2:
            return "班長";
        case 3:
            return "一般A";
        case 4:
            return "一般B";
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
function dealType($type, $service_type){
    if($type == 5){
        return "포인트";
    }
    switch ($service_type) {
        case 1:
            return "가상계좌";
        case 2:
            return "계좌이체";
    }
    return "";
}
function serviceType($pay_type){
    switch ($pay_type) {
        case 1:
            return "가상계좌";
        case 2:
            return "계좌이체";
    }
    return "";
}
function payStatus($pay_status){
    switch ($pay_status) {
        case 0:
            return "대기중";
        case 1:
            return "결제됨";
    }
    return "";
}
function coinType($coin_type){
    switch ($coin_type) {
        case 1:
            return "구매";
        case 2:
            return "판매";
    }
    return "";
}
function sendType($send_type){
    switch ($send_type) {
        case 1:
            return "일회성";
        case 2:
            return "매일";
        case 3:
            return "매주";
        case 4:
            return "매월";
    }
    return "";
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

