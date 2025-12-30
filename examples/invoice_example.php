<?php

/**
 * 发票客户端使用示例
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
    $invoiceClient = $sdk->getClient('invoice');
    
    // 1. 查询增值税专用发票
    echo "1. 查询增值税专用发票\n";
    $result1 = $invoiceClient->queryZzsfpCy([
        [
            "fpdm" => "044031900111",
            "fphm" => "12345678",
            "kprq" => "2024-01-15",
            "je" => 1170.00
        ]
    ]);
    print_r($result1);
    
    // 2. 查询数电票
    echo "\n2. 查询数电票\n";
    $result2 = $invoiceClient->queryInvoice('dppt', [
        [
            "fpdm" => "044031900111",
            "fphm" => "12345678",
            "kprq" => "2024-01-15",
            "je" => 1170.00
        ]
    ]);
    print_r($result2);
    
    // 3. 同步获取数电票版式文件
    echo "\n3. 同步获取数电票版式文件\n";
    $result3 = $invoiceClient->bswjxz([
        'invoiceCode' => '044031900111',
        'invoiceNumber' => '12345678'
    ]);
    print_r($result3);
    
    // 4. 异步获取数电票版式文件
    echo "\n4. 异步获取数电票版式文件\n";
    $result4 = $invoiceClient->asyncBswjxz([
        'invoiceCode' => '044031900111',
        'invoiceNumber' => '12345678',
        'callbackUrl' => 'https://your-callback-url.com/callback'
    ]);
    print_r($result4);
    
    // 5. 入账状态及用途标签查询
    echo "\n5. 入账状态及用途标签查询\n";
    $result5 = $invoiceClient->ytbqCx([
        'fpdm' => '044031900111',
        'fphm' => '12345678'
    ]);
    print_r($result5);
    
} catch (QixiangyunException $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
}