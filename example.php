<?php

// 引入SDK自动加载器
require_once __DIR__ . '/src/autoload.php';

use QixiangyunSDK\SDK;

// 初始化SDK
$sdk = SDK::create([
    'appKey' => 'your_app_key',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => 'your_app_secret',
    'timeout' => 30,
    'enableCache' => true,
    'cacheDir' => __DIR__ . '/cache' // 可选，默认使用系统临时目录
]);

try {
    // 获取发票客户端
    $invoiceClient = $sdk->getClient('invoice');
    
    // 查询增值税专用发票
    $result = $invoiceClient->queryZzsfpCy([
        [
            "fpdm" => "34******30",
            "fphm" => "17****68",
            "kprq" => "2021-11-01",
            "je" => 1421.63
        ],
        [
            "fpdm" => "34******31",
            "fphm" => "17****69",
            "kprq" => "2021-11-02",
            "je" => 2567.89
        ]
    ]);
    
    echo "查询结果:\n";
    print_r($result);
    
    // 使用通用方法查询发票
    $result2 = $invoiceClient->queryInvoice('ptfp', [
        [
            "fpdm" => "34******32",
            "fphm" => "17****70",
            "kprq" => "2021-11-03",
            "je" => 890.45
        ]
    ]);
    
    echo "查询结果2:\n";
    print_r($result2);
    
} catch (Exception $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "堆栈跟踪:\n" . $e->getTraceAsString() . "\n";
}