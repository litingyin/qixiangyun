<?php
const

APPKEY  = '填写自己的appkey',    //  填写自己的appkey
SERCET  = '填写自己的sercet',    //  填写自己的sercet

TOKEN_URL   ='https://api.qixiangyun.com/v2/public/oauth2/login',   //  获取token url
REQUEST_URL   = 'https://api.qixiangyun.com/v2/invoice/cy/zzsfpCy', //  查询发票 url
end = '';
//  获取请求参数
//  发票查询请求参数
$request = json_encode([
    "cyList" => [
        [
            "fpdm" => "34******30",
            "fphm" => "17****68",
            "kprq" => "2021-11-01",
            "je" => 1421.63
        ]
    ]
]);
// 获取 access_token
$token = '';
// todo   token可以保存到缓存中，有效期十五天。有效期内不用重新获取，过期后再重新获取
$tokenParams = $base = [];
$tokenParams['grant_type']      =   'client_credentials';
$tokenParams['client_appkey']   =  APPKEY;
$tokenParams['client_secret']   = md5(SERCET);
$tokenParams = json_encode($tokenParams);
$returnDate = posturl(TOKEN_URL, $tokenParams);

if(isset($returnDate['value']['access_token'])){
    $token = $returnDate['value']['access_token'];
}else{
    return '获取token失败！';
}

//  组装查询发票的参数
$base['req_date'] = time() * 1000;
$base['access_token'] =$token;

$signStr = 'POST'.'_'.md5($request).'_'.$base['req_date'].'_'.$base['access_token'].'_'.SERCET;
$signStr ='API-SV1'.':'.$tokenParams['client_appkey'].':'. base64_encode(md5($signStr));

$base['req_sign'] = $signStr;

$returnDate = posturl(REQUEST_URL, $request, $base);
print_r($returnDate);
/**
* 发送 post 请求
* @param String $url
* @param String $data
* @param Array $requestHander
* @return void
*/
function posturl(String  $url, String $data, Array $requestHander=[]){
    if($requestHander){
    $header = array(
        'Content-Type: application/json; charset=utf-8',
        'req_date: '.$requestHander['req_date'],
        'access_token: '.$requestHander['access_token'],
        'req_sign: '.$requestHander['req_sign']
    );
    }else{
        $header = array(
            'Content-Type: application/json; charset=utf-8',
        );
    }
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 超时设置
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);

    // 超时设置，以毫秒为单位
    // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

    // 设置请求头
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );

    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //执行命令
    $data = curl_exec($curl);
    // 显示错误信息
    if (curl_error($curl)) {
        return  "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return json_decode($data, true);
    }


}