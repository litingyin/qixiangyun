<?php

/**
 * 登录客户端使用示例
 */

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\SDK;
use QixiangyunSDK\Exceptions\QixiangyunException;

$config = [
    'appKey' => 'your_app_key',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => 'your_app_secret',
    'timeout' => 30,
    'enableCache' => true,
    'cacheDir' => __DIR__ . '/cache'
];

try {
    $sdk = SDK::create($config);
    $loginClient = $sdk->getClient('login');
    $nsrsbh = '91110000XXXXXXX';  // 纳税人识别号
    
    // 方式1: 账号密码登录
    echo "1. 账号密码登录\n";
    
    // 先检查账号密码
    $checkResult = $loginClient->checkAccount([
        'nsrsbh' => $nsrsbh,
        'userCode' => 'admin',
        'password' => 'your_password'
    ]);
    print_r($checkResult);
    
    // 方式2: 税务APP登录
    echo "\n2. 税务APP登录\n";
    
    // 发送短信验证码
    $smsResult = $loginClient->remoteEtaxcookie([
        'nsrsbh' => $nsrsbh,
        'userCode' => 'your_phone_number'
    ]);
    print_r($smsResult);
    
    // 上传短信验证码
    if (!empty($smsResult['value']['taskId'])) {
        $pushSmsResult = $loginClient->remotePushsms([
            'nsrsbh' => $nsrsbh,
            'taskId' => $smsResult['value']['taskId'],
            'smsCode' => '123456'  // 用户输入的验证码
        ]);
        print_r($pushSmsResult);
    }
    
    // 方式3: 扫码登录
    echo "\n3. 扫码登录\n";
    
    // 获取二维码
    $qrcodeResult = $loginClient->getQrcode([
        'nsrsbh' => $nsrsbh
    ]);
    print_r($qrcodeResult);
    
    // 检查二维码扫描状态
    if (!empty($qrcodeResult['value']['taskId'])) {
        // 用户扫码后，确认登录
        $loginResult = $loginClient->qrcodeLogin([
            'nsrsbh' => $nsrsbh,
            'taskId' => $qrcodeResult['value']['taskId']
        ]);
        print_r($loginResult);
    }
    
    // 方式4: 代理登录
    echo "\n4. 代理登录\n";
    
    // 获取企业列表
    $orgListResult = $loginClient->proxyOrgList([
        'userCode' => 'proxy_account',
        'password' => 'proxy_password'
    ]);
    print_r($orgListResult);
    
    // 方式5: 校验快速登录状态
    echo "\n5. 校验快速登录状态\n";
    
    $cacheResult = $loginClient->checkCache([
        'nsrsbh' => $nsrsbh
    ]);
    print_r($cacheResult);
    
    // 方式6: 登出
    echo "\n6. 登出\n";
    
    $logoutResult = $loginClient->loginOut([
        'nsrsbh' => $nsrsbh
    ]);
    print_r($logoutResult);
    
} catch (QixiangyunException $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
}