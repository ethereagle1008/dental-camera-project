<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AdData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-ad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for get ad info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getAd();
        return 0;
    }

    public function loginAd($email, $pw){
        $device = mt_rand(1000000000, 9999999999);
        $postData = [
            'email' => $email,
            'password' => $pw
        ];
        $url = "https://www.pipiads.com/v1/api/member/login";
        $ch = curl_init($url);
        $authorization = "device_id: " . $device;
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpcode == 200)
        {
            $tokenData = json_decode($response, true);
            Account::where('email', $email)->update(['access_token' => $tokenData['access_token'], 'device_id' => $device]);
            return true;
        }
        else{
            Log::error('loginAd error:' . $response);
            return false;
        }
    }

    public function getAd(){
        $accounts = Account::all()->toArray();
        $min = date('i');
        $numbers = range(0, 9);
        if($min%10 == 0 ){
            shuffle($numbers);
        }
        $num = $numbers[$min%10];
        if(!isset($accounts[$num]['access_token'])){
            if($this->loginAd($accounts[$num]['email'], $accounts[$num]['password'])){
                $accunt = Account::where('email', $accounts[$num]['email'])->first();
                $access_token = $accunt->access_token;
                $device_id = $accunt->device_id;
                Log::info('client_email: ' . $accounts[$num]['email']);
                $this->searchAd($access_token, $device_id);
            }
        }
        else{
            Log::info('client_email: ' . $accounts[$num]['email']);
            $this->searchAd($accounts[$num]['access_token'], $accounts[$num]['device_id']);
        }

        return response()->json(['status' => true]);
    }

    public function searchAd($accss_token, $device_id){
        $headers  = [
            'Cookie: uid=' .$accss_token,
            'Content-Type: application/json',
            'access_token: ' .$accss_token,
            'device_id: ' . $device_id
        ];
        $postData = [
            "button" => [],
            "channel" => 0,
            "current_page" => 1,
            "exclude_history"=> 0,
            "exclude_word"=> [],
            "keyword"=> [],
            "page_size"=> 20,
            "region"=> [],
            "search_type"=> 1,
            "sort"=> 1
        ];
        $url = "https://www.pipiads.com/v1/api/at/video/search";
        $ch = curl_init($url);
//        $access_token = "access_token: " . $accss_token;
//        $device = "device_id: " . $device_id;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpcode == 200)
        {
            $result = json_decode($response, true);
            $data = $result['result']['data'];
            foreach ($data as $item){
                $ad_id = $item['ad_id'];
                $ad = [
                    'ad_id' => $item['ad_id'],
                    'play_count' => $item['play_count'],
                    'share_count' => $item['share_count'],
                    'digg_count' => $item['digg_count'],
                    'video_url' => $item['video_url'],
                    'duration' => $item['duration'],
                    'create_time' => $item['tiktok_create_time'],
                    'app_name' => $item['app_name'],
                    'app_url' => $item['app_url'],
                    'root_path' => $item['root_path'],
                    'desc' => $item['desc'],
                    'app_image' => $item['app_image'],
                    'app_title' => $item['app_title'],
                    'url' => $item['url'],
                    'cover' => $item['cover'],
                ];
                \App\Models\AdData::updateOrCreate(['ad_id' => $ad_id], $ad);
            }
            return true;
        }
        else{
            Log::error('searchAd error:' . $response);
            return false;
        }
    }
}
