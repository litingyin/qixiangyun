<?php

/**
 * 错误处理和重试机制示例
 */

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\SDK;
use QixiangyunSDK\Exceptions\QixiangyunException;
use QixiangyunSDK\Exceptions\AuthTokenException;

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
    
    // 获取HTTP客户端配置重试参数
    $httpClient = $sdk->getConfig()->getHttpClient();
    $httpClient->setMaxRetries(3);           // 最大重试次数
    $httpClient->setRetryDelay(1000);         // 重试延迟（毫秒）
    
    $invoiceClient = $sdk->getClient('invoice');
    
    // 执行API调用，SDK会自动处理重试
    echo "执行API调用（带自动重试）...\n";
    $result = $invoiceClient->queryZzsfpCy([
        [
            "fpdm" => "044031900111",
            "fphm" => "12345678",
            "kprq" => "2024-01-15",
            "je" => 1170.00
        ]
    ]);
    print_r($result);
    
} catch (AuthTokenException $e) {
    // 认证错误
    echo "【认证错误】" . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
    
    // 清除token缓存并重试
    echo "正在清除token缓存...\n";
    $sdk->getConfig()->getHttpClient()->clearTokenCache();
    
} catch (QixiangyunException $e) {
    // API错误
    echo "【API错误】" . $e->getMessage() . "\n";
    echo "错误代码: " . $e->getErrorCode() . "\n";
    
    // 检查是否是特定类型的错误
    switch ($e->getErrorCode()) {
        case 'NETWORK_ERROR':
            echo "网络错误，请检查网络连接\n";
            break;
        case 'RATE_LIMIT_ERROR':
            echo "请求过于频繁，请稍后重试\n";
            break;
        case 'VALIDATION_ERROR':
            echo "请求参数验证失败\n";
            if ($responseData = $e->getResponseData()) {
                echo "验证详情: " . json_encode($responseData, JSON_UNESCAPED_UNICODE) . "\n";
            }
            break;
        default:
            echo "未知错误\n";
            break;
    }
    
} catch (\Exception $e) {
    // 系统错误
    echo "【系统错误】" . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
}

// 自定义错误处理函数示例
function safeApiCall(callable $apiCall, int $maxRetries = 3): ?array
{
    $lastException = null;
    
    for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
        try {
            return $apiCall();
        } catch (QixiangyunException $e) {
            $lastException = $e;
            
            // 对于某些错误，不重试
            if ($e instanceof AuthTokenException || $e->getErrorCode() === 'VALIDATION_ERROR') {
                throw $e;
            }
            
            // 最后一次尝试失败，抛出异常
            if ($attempt === $maxRetries) {
                throw $e;
            }
            
            // 指数退避等待
            $waitTime = pow(2, $attempt) * 1000; // 2^attempt 秒
            echo "第 {$attempt} 次尝试失败，{$waitTime}ms 后重试...\n";
            usleep($waitTime * 1000);
        }
    }
    
    throw $lastException;
}

// 使用自定义错误处理
try {
    echo "\n使用自定义错误处理调用API...\n";
    $result = safeApiCall(function() use ($invoiceClient) {
        return $invoiceClient->queryZzsfpCy([
            [
                "fpdm" => "044031900111",
                "fphm" => "12345678",
                "kprq" => "2024-01-15",
                "je" => 1170.00
            ]
        ]);
    });
    print_r($result);
    
} catch (QixiangyunException $e) {
    echo "所有重试均失败: " . $e->getMessage() . "\n";
}