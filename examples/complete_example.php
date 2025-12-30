<?php

/**
 * 企享云SDK完整使用示例
 */

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\SDK;
use QixiangyunSDK\Exceptions\QixiangyunException;
use QixiangyunSDK\Exceptions\AuthTokenException;

// 初始化SDK配置
$config = [
    'appKey' => 'your_app_key',          // 替换为您的appKey
    'apiHost' => 'https://api.qixiangyun.com',  // API地址
    'appSecret' => 'your_app_secret',    // 替换为您的appSecret
    'timeout' => 30,                     // 请求超时时间（秒）
    'enableCache' => true,                // 是否启用token缓存
    'cacheDir' => __DIR__ . '/cache'     // token缓存目录
];

try {
    // 1. 创建SDK实例
    $sdk = SDK::create($config);
    echo "SDK初始化成功\n";
    
    // 2. 获取发票客户端
    $invoiceClient = $sdk->getClient('invoice');
    echo "获取发票客户端成功\n";
    
    // 3. 查询增值税专用发票
    echo "\n=== 查询增值税专用发票 ===\n";
    $invoiceResult = $invoiceClient->queryZzsfpCy([
        [
            "fpdm" => "044031900111",
            "fphm" => "12345678",
            "kprq" => "2024-01-15",
            "je" => 1170.00
        ]
    ]);
    print_r($invoiceResult);
    
    // 4. 获取企业管理客户端
    $orgClient = $sdk->getClient('org');
    echo "\n=== 获取企业管理客户端 ===\n";
    
    // 5. 发起企业基本信息
    echo "\n=== 发起企业基本信息 ===\n";
    $orgInfoResult = $orgClient->beginOrgInfoTask([
        'nsrsbh' => '91110000XXXXXXX',  // 纳税人识别号
        'taskId' => uniqid('task_')
    ]);
    print_r($orgInfoResult);
    
    // 6. 获取登录客户端
    $loginClient = $sdk->getClient('login');
    echo "\n=== 获取登录客户端 ===\n";
    
    // 7. 账密检查
    echo "\n=== 账密检查 ===\n";
    $checkResult = $loginClient->checkAccount([
        'nsrsbh' => '91110000XXXXXXX',
        'userCode' => 'admin',
        'password' => 'your_password'
    ]);
    print_r($checkResult);
    
    // 8. 获取账号管理客户端
    $accountClient = $sdk->getClient('account');
    echo "\n=== 获取账号管理客户端 ===\n";
    
    // 9. 查询托管账号
    echo "\n=== 查询托管账号 ===\n";
    $accountResult = $accountClient->queryAccount([
        'nsrsbh' => '91110000XXXXXXX',
        'userCode' => 'admin'
    ]);
    print_r($accountResult);
    
    // 10. 获取税务申报客户端
    $taxClient = $sdk->getClient('tax');
    echo "\n=== 获取税务申报客户端 ===\n";
    
    // 11. 发起申报任务
    echo "\n=== 发起申报任务 ===\n";
    $declareResult = $taxClient->loadDeclareTask([
        'nsrsbh' => '91110000XXXXXXX',
        'sbmx' => [
            [
                'zsxmm_dm' => '10101',
                'zsxmm_mc' => '增值税',
                'sqssqq' => '202401',
                'sqssqz' => '202401'
            ]
        ]
    ]);
    print_r($declareResult);
    
    // 12. 获取个税客户端
    $iitClient = $sdk->getClient('iit');
    echo "\n=== 获取个税客户端 ===\n";
    
    // 13. 企业注册
    echo "\n=== 企业注册 ===\n";
    $registerResult = $iitClient->getCompanyRegisterInfo([
        'nsrsbh' => '91110000XXXXXXX',
        'nsrmc' => 'XX科技有限公司'
    ]);
    print_r($registerResult);
    
    echo "\n=== 示例执行完成 ===\n";
    
} catch (AuthTokenException $e) {
    echo "认证错误: " . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
    
} catch (QixiangyunException $e) {
    echo "API错误: " . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
    
    if ($responseData = $e->getResponseData()) {
        echo "响应数据: " . json_encode($responseData, JSON_UNESCAPED_UNICODE) . "\n";
    }
    
} catch (\Exception $e) {
    echo "系统错误: " . $e->getMessage() . "\n";
    echo "堆栈跟踪: " . $e->getTraceAsString() . "\n";
}