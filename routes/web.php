<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notify', function (Request $request) {
    echo 'notifyGet';

    echo $request;

    $url = 'https://api.telegram.org/bot7043828057:AAFI5aLJvtCgo-aIZO8Q-6PDiSctCxZ79yU/sendMessage?chat_id=6635332924&text=1234';

    $res = Get_Pay($url);


//    $url2 = 'https://api.telegram.org/bot7043828057:AAFI5aLJvtCgo-aIZO8Q-6PDiSctCxZ79yU/sendMessage?chat_id=6635332924&text=' . $res;

//    $postUrl = 'http://127.0.0.1:8000/notifyPost';
//    $re = post_url($postUrl);
//    echo $re;

//    echo $res;

    return $request;
});


Route::post('/notifyPost', function (Request $request) {

    dd(1);

//    $url1 = 'https://api.telegram.org/bot7043828057:AAFI5aLJvtCgo-aIZO8Q-6PDiSctCxZ79yU/sendMessage?chat_id=6635332924&text=post';
//
//    Get_Pay($url1);


    return $request;
});

/**
 * API请求
 * @param $url  链接
 * @param $data  参数
 */
function Get_Pay($url, $data = null, array $heders = [], $time = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time);          //单位 秒，也可以使用
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //这个是重点,规避ssl的证书检查。
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    if (!empty($heders)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $heders);
    }
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

/**
 * post请求
 * @param $url  string api链接
 * @param $url  array 参数
 * @param $time_out int 超时时间
 */
function post_url(string $url, array $data = [], $time_out = 5)
{
    $data = json_encode($data);
    $headerArray = array("Content-type: application/json;charset='utf-8'");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $time_out);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return json_decode($output, true);
}
