<?php

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\SDK;
use QixiangyunSDK\Clients\InvoiceClient;
use QixiangyunSDK\Clients\OrgClient;

// 创建SDK实例
$sdk = SDK::create([
    'appKey' => 'your_app_key',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => 'your_app_secret'
]);

// 示例1：基本链式操作
echo "=== 示例1：基本链式操作 ===\n";

// 获取发票客户端并查询发票
$invoiceClient = $sdk->getClient('invoice');
$response = $invoiceClient->queryZzsfpCy([
    [
        'fpdm' => '12345678901234567890',
        'fphm' => '12345678',
        'kprq' => '2023-01-01',
        'je' => '100.00'
    ]
]);

// 链式处理发票数据
$response
    ->processInvoice(function($invoiceData, $response) {
        echo "发票代码: " . $invoiceData['code'] . "\n";
        echo "发票号码: " . $invoiceData['number'] . "\n";
        echo "发票金额: " . number_format($invoiceData['amount'], 2) . "\n";
        echo "购买方: " . $invoiceData['purchaser'] . "\n";
        echo "销售方: " . $invoiceData['seller'] . "\n";
        return $response;
    })
    ->catch(function($error, $statusCode) {
        echo "查询发票失败: " . $error . " (状态码: " . $statusCode . ")\n";
    })
    ->finally(function($response) {
        echo "发票查询操作完成\n\n";
    });

// 示例2：多级链式操作
echo "=== 示例2：多级链式操作 ===\n";

// 获取企业客户端并查询企业信息
$orgClient = $sdk->getClient('org');
$orgResponse = $orgClient->getOrgInfo(['orgId' => '12345']);

// 链式处理企业数据，然后继续处理发票
$orgResponse
    ->processOrg(function($orgData, $response) use ($invoiceClient) {
        echo "企业名称: " . $orgData['name'] . "\n";
        echo "统一社会信用代码: " . $orgData['creditCode'] . "\n";
        
        // 根据企业信息继续查询发票
        return $invoiceClient->queryPtfpCy([
            [
                'fpdm' => '09876543210987654321',
                'fphm' => '87654321',
                'kprq' => '2023-01-15',
                'je' => '200.00'
            ]
        ]);
    })
    ->then(function($invoiceResponse) {
        // 处理后续的发票响应
        return $invoiceResponse
            ->processInvoice(function($invoiceData) {
                echo "企业关联发票金额: " . number_format($invoiceData['amount'], 2) . "\n";
                return $invoiceData;
            });
    })
    ->catch(function($error) {
        echo "操作过程中出错: " . $error . "\n";
    })
    ->finally(function($response) {
        echo "企业信息和发票查询操作完成\n\n";
    });

// 示例3：条件链式操作
echo "=== 示例3：条件链式操作 ===\n";

$taxClient = $sdk->getClient('tax');
$taxResponse = $taxClient->loadDeclareTask([
    'aggOrgId' => '12345',
    'taxType' => '增值税',
    'taxPeriod' => '2023-01'
]);

// 根据申报状态进行不同的处理
$taxResponse
    ->then(function($data) use ($taxClient) {
        $status = $data['status'] ?? '';
        
        if ($status === 'success') {
            // 申报成功，继续获取申报结果
            return $taxClient->queryTaskInfo(['taskId' => $data['taskId'] ?? '']);
        } elseif ($status === 'processing') {
            echo "申报正在处理中...\n";
            return null; // 结束链式操作
        } else {
            echo "申报失败: " . ($data['message'] ?? '未知错误') . "\n";
            return null; // 结束链式操作
        }
    })
    ->then(function($resultResponse) {
        if ($resultResponse) {
            echo "申报结果: " . json_encode($resultResponse->getData(), JSON_UNESCAPED_UNICODE) . "\n";
        }
    })
    ->catch(function($error) {
        echo "申报过程中出错: " . $error . "\n";
    });

// 示例4：类型安全操作
echo "=== 示例4：类型安全操作 ===\n";

$productClient = $sdk->getClient('product');
$productResponse = $productClient->getProduct(['productId' => 'PROD123']);

// 类型安全的链式操作
$productResponse
    ->processProduct(function($productData) {
        // 类型安全：确保数据类型正确
        $productId = (string)($productData['id'] ?? '');
        $productName = (string)($productData['name'] ?? '');
        $price = (float)($productData['price'] ?? 0);
        $isActive = (bool)($productData['isActive'] ?? false);
        
        echo "产品ID: " . $productId . "\n";
        echo "产品名称: " . $productName . "\n";
        echo "产品价格: " . number_format($price, 2) . "\n";
        echo "产品状态: " . ($isActive ? '激活' : '未激活') . "\n";
        
        // 类型验证
        if (empty($productId)) {
            throw new \InvalidArgumentException("产品ID不能为空");
        }
        
        if ($price <= 0) {
            throw new \InvalidArgumentException("产品价格必须大于0");
        }
        
        return $productData;
    })
    ->catch(function($error) {
        echo "产品处理错误: " . $error . "\n";
    });

// 示例5：错误处理和重试
echo "=== 示例5：错误处理和重试 ===\n";

$maxRetries = 3;
$retryCount = 0;

function queryInvoiceWithRetry($invoiceClient, $params, $maxRetries, &$retryCount) {
    $response = $invoiceClient->queryZzsfpCy($params);
    
    return $response
        ->then(function($data) use (&$retryCount) {
            echo "发票查询成功\n";
            return $data;
        })
        ->catch(function($error, $statusCode) use ($invoiceClient, $params, $maxRetries, &$retryCount) {
            echo "发票查询失败: " . $error . " (状态码: " . $statusCode . ")\n";
            
            $retryCount++;
            if ($retryCount <= $maxRetries && $statusCode >= 500) {
                echo "重试 (" . $retryCount . "/" . $maxRetries . ")...\n";
                sleep(1); // 等待1秒后重试
                return queryInvoiceWithRetry($invoiceClient, $params, $maxRetries, $retryCount);
            } else {
                echo "已达到最大重试次数，停止重试\n";
                return null;
            }
        });
}

// 执行带重试的查询
$queryParams = [
    [
        'fpdm' => '98765432109876543210',
        'fphm' => '43210987',
        'kprq' => '2023-02-01',
        'je' => '300.00'
    ]
];

queryInvoiceWithRetry($invoiceClient, $queryParams, $maxRetries, $retryCount);

echo "\n=== 链式操作SDK示例完成 ===\n";