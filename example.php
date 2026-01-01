<?php

// 引入SDK自动加载器
require_once __DIR__ . '/src/autoload.php';

use QixiangyunSDK\SDK;

// 初始化SDK
$sdk = SDK::create([
    'appKey' => '10003045',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => '177WC3539UXRJP93C76VSN5CXF221YKSD35K3G59RK4FTVL9',
    'timeout' => 30,
    'enableCache' => true,
    'cacheDir' => __DIR__ . '/cache' // 可选，默认使用系统临时目录
]);

try {
    echo "========================================\n";
    echo "示例 1: 使用便捷方法获取发票客户端\n";
    echo "========================================\n";

    // 推荐方式：使用便捷方法获取客户端
    $invoiceClient = $sdk->getInvoice();

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

    echo "\n========================================\n";
    echo "示例 2: 链式操作示例\n";
    echo "========================================\n";

    // 使用链式操作处理发票查询结果
    $response = $invoiceClient->queryZzsfpCy([
        [
            "fpdm" => "34******33",
            "fphm" => "17****71",
            "kprq" => "2021-11-04",
            "je" => 890.45
        ]
    ]);

    // 链式处理
    $response
        ->then(function($data) {
            echo "✓ 查询成功\n";
            echo "数据条数: " . count($data) . "\n";
            return $data;
        })
        ->catch(function($error, $statusCode) {
            echo "✗ 查询失败: " . $error . "\n";
            echo "状态码: " . $statusCode . "\n";
        })
        ->finally(function($response) {
            echo "操作完成\n";
        });

    echo "\n========================================\n";
    echo "示例 3: 类型化数据处理\n";
    echo "========================================\n";

    // 类型化数据处理
    $response->processInvoice(function($invoiceData) {
        echo "发票代码: " . $invoiceData['code'] . "\n";
        echo "发票号码: " . $invoiceData['number'] . "\n";
        echo "发票金额: " . number_format($invoiceData['amount'], 2) . "\n";
        return $invoiceData;
    });

    echo "\n========================================\n";
    echo "示例 4: 多客户端协同操作\n";
    echo "========================================\n";

    // 使用多个客户端
    $orgClient = $sdk->getOrg();
    $taxClient = $sdk->getTax();
    $loginClient = $sdk->getLogin();

    echo "✓ 已获取企业客户端\n";
    echo "✓ 已获取税务客户端\n";
    echo "✓ 已获取登录客户端\n";

    echo "\n========================================\n";
    echo "示例 5: 使用通用方法获取客户端\n";
    echo "========================================\n";

    // 通用方法（仍然支持）
    $invoiceClient2 = $sdk->getClient('invoice');

    // 使用通用方法查询发票
    $result2 = $invoiceClient2->queryInvoice('ptfp', [
        [
            "fpdm" => "34******34",
            "fphm" => "17****72",
            "kprq" => "2021-11-05",
            "je" => 890.45
        ]
    ]);

    echo "查询结果:\n";
    print_r($result2);

    echo "\n========================================\n";
    echo "示例 6: 所有可用的便捷方法\n";
    echo "========================================\n";

    // 展示所有可用的客户端获取方法
    $clients = [
        'getInvoice' => '发票客户端',
        'getOrg' => '企业管理客户端',
        'getAccount' => '账号管理客户端',
        'getLogin' => '登录客户端',
        'getTax' => '税务申报客户端',
        'getIit' => '个税客户端',
        'getBsrygl' => '办税人员管理客户端',
        'getProduct' => '产品管理客户端',
        'getOrgInfo' => '企业信息采集客户端',
        'getMessage' => '消息客户端',
        'getPhone' => '办税小号客户端',
        'getQdfp' => '前台发票客户端',
        'getSpxx' => '商品信息客户端',
        'getKhxx' => '客户信息客户端',
        'getRz' => '认证客户端',
        'getSdFile' => '文件版式下载客户端',
        'getFpruz' => '发票入账客户端',
        'getGj' => '发票归集客户端',
        'getOrgTaxInfo' => '企业税务信息客户端',
        'getQys' => '企业税种客户端',
        'getScjy' => '生产经营所得客户端',
        'getShbx' => '社保客户端',
        'getCustoms' => '海关客户端',
        'getCkts' => '出口退税客户端',
        'getCollect' => '企业采集客户端',
        'getRisk' => '风险查询客户端',
        'getInsight' => '企业洞察客户端',
        'getLegislation' => '政策法规客户端'
    ];

    foreach ($clients as $method => $description) {
        echo "- {$method}() - {$description}\n";
    }

    echo "\n✓ 示例运行完成！\n";

} catch (Exception $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "堆栈跟踪:\n" . $e->getTraceAsString() . "\n";
}