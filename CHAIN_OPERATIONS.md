# 企享云SDK链式操作指南

## 概述

企享云SDK现已支持链式操作，提供了类型安全的响应对象，使API调用更加直观和易于维护。链式操作允许您在单一表达式中完成多个操作，提高了代码的可读性和可维护性。

## 核心特性

### 1. 类型化响应

SDK为不同类型的API返回提供了专门的响应类：

- **InvoiceResponse** - 发票相关API响应
- **OrgResponse** - 企业信息相关API响应
- **TaxResponse** - 税务申报相关API响应
- **ProductResponse** - 产品管理相关API响应
- **AccountResponse** - 账户管理相关API响应

### 2. 链式操作方法

所有响应类都支持以下链式操作方法：

- `then(callable $callback)` - 成功时执行回调
- `catch(callable $callback)` - 失败时执行回调
- `finally(callable $callback)` - 无论成功失败都执行回调

### 3. 类型安全

每个响应类都提供了类型安全的方法来获取特定数据：

- 发票：`getInvoiceCode()`, `getInvoiceNumber()`, `getAmount()` 等
- 企业：`getOrgName()`, `getCreditCode()`, `getLegalRepresentative()` 等
- 税务：`getTaskId()`, `getStatus()`, `getTaxAmount()` 等
- 产品：`getProductId()`, `getProductName()`, `getPrice()` 等
- 账户：`getAccountId()`, `getUsername()`, `getPermissions()` 等

## 使用方法

### 基本使用

```php
use QixiangyunSDK\SDK;

// 创建SDK实例
$sdk = SDK::create([
    'appKey' => 'your_app_key',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => 'your_app_secret'
]);

// 获取客户端
$invoiceClient = $sdk->getClient('invoice');

// 调用API并获取类型化响应
$response = $invoiceClient->queryZzsfpCy($params);

// 获取特定数据
$invoiceCode = $response->getInvoiceCode();
$amount = $response->getAmount();

// 检查是否成功
if ($response->isValid()) {
    echo "发票代码: " . $invoiceCode;
    echo "金额: " . $amount;
}
```

### 链式操作

```php
$response = $invoiceClient->queryZzsfpCy($params)
    ->then(function($data) {
        echo "查询成功，处理发票数据\n";
        // 处理数据
        return processData($data);
    })
    ->catch(function($error, $statusCode) {
        echo "查询失败: " . $error . " (状态码: " . $statusCode . ")\n";
        // 错误处理
        logError($error);
    })
    ->finally(function($response) {
        echo "操作完成\n";
        // 清理资源
        cleanup();
    });
```

### 处理特定业务数据

```php
// 发票数据处理
$response->processInvoice(function($invoiceData) {
    echo "发票代码: " . $invoiceData['code'] . "\n";
    echo "发票号码: " . $invoiceData['number'] . "\n";
    echo "发票金额: " . number_format($invoiceData['amount'], 2) . "\n";
    
    // 进一步处理
    if ($invoiceData['amount'] > 1000) {
        echo "大额发票，需要特别处理\n";
    }
    
    return $invoiceData;
});

// 企业数据处理
$response->processOrg(function($orgData) {
    echo "企业名称: " . $orgData['name'] . "\n";
    echo "统一社会信用代码: " . $orgData['creditCode'] . "\n";
    
    // 验证企业状态
    if ($orgData['status'] !== 'active') {
        echo "企业状态异常\n";
    }
    
    return $orgData;
});
```

### 多级链式操作

```php
$orgClient = $sdk->getClient('org');
$invoiceClient = $sdk->getClient('invoice');

// 先查询企业信息，然后根据企业信息查询发票
$orgClient->getOrgInfo(['orgId' => $orgId])
    ->processOrg(function($orgData) use ($invoiceClient) {
        // 根据企业信息决定查询哪些发票
        if ($orgData['status'] === 'active') {
            return $invoiceClient->queryZzsfpCy($invoiceParams);
        } else {
            echo "企业未激活，无法查询发票\n";
            return null;
        }
    })
    ->then(function($invoiceResponse) {
        if ($invoiceResponse) {
            return $invoiceResponse->processInvoice(function($invoiceData) {
                echo "企业关联发票: " . $invoiceData['number'] . "\n";
                return $invoiceData;
            });
        }
    });
```

### 错误处理和重试

```php
function queryWithRetry($client, $params, $maxRetries = 3) {
    $retryCount = 0;
    
    return $client->query($params)
        ->then(function($data) {
            echo "查询成功\n";
            return $data;
        })
        ->catch(function($error, $statusCode) use ($client, $params, $maxRetries, &$retryCount) {
            $retryCount++;
            
            if ($retryCount <= $maxRetries && $statusCode >= 500) {
                echo "重试 (" . $retryCount . "/" . $maxRetries . ")...\n";
                sleep(1);
                return queryWithRetry($client, $params, $maxRetries);
            } else {
                echo "已达到最大重试次数\n";
                throw new Exception("查询失败: " . $error);
            }
        });
}
```

### 类型安全操作

```php
$response = $productClient->getProduct($params);

// 类型安全的数据处理
$response->processProduct(function($productData) {
    // 确保数据类型正确
    $productId = (string)($productData['id'] ?? '');
    $price = (float)($productData['price'] ?? 0);
    $isActive = (bool)($productData['isActive'] ?? false);
    
    // 类型验证
    if (empty($productId)) {
        throw new InvalidArgumentException("产品ID不能为空");
    }
    
    if ($price < 0) {
        throw new InvalidArgumentException("产品价格不能为负数");
    }
    
    // 类型安全的使用
    $formattedPrice = number_format($price, 2);
    $statusText = $isActive ? '激活' : '未激活';
    
    echo "产品ID: " . $productId . "\n";
    echo "产品价格: " . $formattedPrice . "\n";
    echo "产品状态: " . $statusText . "\n";
    
    return [
        'id' => $productId,
        'price' => $price,
        'isActive' => $isActive,
        'formattedPrice' => $formattedPrice,
        'statusText' => $statusText
    ];
});
```

## 最佳实践

1. **使用类型化响应**：总是使用提供的类型化方法来获取数据，而不是直接访问原始数组。

2. **链式处理结果**：利用`then`, `catch`, `finally`方法进行流畅的结果处理。

3. **使用业务特定的处理方法**：如`processInvoice`, `processOrg`等，它们提供了标准化的数据格式。

4. **类型安全**：始终确保数据类型正确，并进行必要的验证。

5. **错误处理**：使用`catch`方法捕获和处理错误，实现重试机制。

6. **资源清理**：使用`finally`方法确保资源被正确释放。

## 类型定义

详细的类型定义和方法说明请参考：
- `src/Core/Types/TypeDefinitions.php` - 完整的类型定义文档
- `src/Core/Types/InvoiceResponse.php` - 发票响应类
- `src/Core/Types/OrgResponse.php` - 企业响应类
- `src/Core/Types/TaxResponse.php` - 税务响应类
- `src/Core/Types/ProductResponse.php` - 产品响应类
- `src/Core/Types/AccountResponse.php` - 账户响应类

## 示例代码

完整的链式操作示例请参考：
- `examples/chained_operations_example.php` - 链式操作使用示例