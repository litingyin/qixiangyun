# 企享云 SDK (PHP)

基于 PHP 7.4 开发的企享云 SDK，提供完整的 API 访问接口和业务功能封装。

## 特性

- 🚀 **完整的 API 覆盖** - 支持企享云所有业务模块
- 🔒 **自动认证管理** - 自动获取并缓存 access_token
- 🔄 **智能重试机制** - 支持请求失败自动重试
- 🎯 **模块化设计** - 按业务领域分离客户端类
- 📝 **完整日志记录** - 可配置的日志输出
- 💪 **类型安全** - 完整的参数验证和异常处理
- 📦 **易于集成** - 简单的 API 调用接口
- ⚡ **链式操作** - 支持流畅的链式调用和类型安全响应

## 安装

```bash
# 使用 Composer 安装（推荐）
composer require qixiangyun/sdk

# 或直接克隆项目
git clone https://github.com/qixiangyun/sdk-php.git
```

## 快速开始

### 基本使用

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
// 或手动引入自动加载器
// require_once __DIR__ . '/src/autoload.php';

use QixiangyunSDK\SDK;

// 1. 初始化 SDK
$sdk = SDK::create([
    'appKey' => 'your_app_key',
    'apiHost' => 'https://api.qixiangyun.com',
    'appSecret' => 'your_app_secret',
    'timeout' => 30,
    'enableCache' => true,
    'cacheDir' => __DIR__ . '/cache'
]);

// 2. 获取业务客户端（推荐使用便捷方法）
$invoiceClient = $sdk->getInvoice();

// 或者使用通用方法
// $invoiceClient = $sdk->getClient('invoice');

// 3. 调用 API
$result = $invoiceClient->queryZzsfpCy([
    [
        "fpdm" => "044031800104",
        "fphm" => "12345678",
        "kprq" => "2024-01-01",
        "je" => 1000.00
    ]
]);

print_r($result);
```

### 便捷获取客户端

SDK 提供了便捷的 `get` 方法来直接获取各个业务客户端：

```php
$sdk = SDK::create($config);

// 发票客户端
$invoiceClient = $sdk->getInvoice();

// 企业管理客户端
$orgClient = $sdk->getOrg();

// 账号管理客户端
$accountClient = $sdk->getAccount();

// 登录客户端
$loginClient = $sdk->getLogin();

// 税务申报客户端
$taxClient = $sdk->getTax();

// 个税客户端
$iitClient = $sdk->getIit();

// 办税人员管理客户端
$bsryglClient = $sdk->getBsrygl();

// 产品管理客户端
$productClient = $sdk->getProduct();

// 企业信息采集客户端
$orgInfoClient = $sdk->getOrgInfo();

// 消息客户端
$messageClient = $sdk->getMessage();

// 办税小号客户端
$phoneClient = $sdk->getPhone();

// 前台发票客户端
$qdfpClient = $sdk->getQdfp();

// 商品信息客户端
$spxxClient = $sdk->getSpxx();

// 客户信息客户端
$khxxClient = $sdk->getKhxx();

// 认证客户端
$rzClient = $sdk->getRz();

// 文件版式下载客户端
$sdFileClient = $sdk->getSdFile();

// 发票入账客户端
$fpruzClient = $sdk->getFpruz();

// 发票归集客户端
$gjClient = $sdk->getGj();

// 企业税务信息客户端
$orgTaxInfoClient = $sdk->getOrgTaxInfo();

// 企业税种客户端
$qysClient = $sdk->getQys();

// 生产经营所得客户端
$scjyClient = $sdk->getScjy();

// 社保客户端
$shbxClient = $sdk->getShbx();

// 海关客户端
$customsClient = $sdk->getCustoms();

// 出口退税客户端
$cktsClient = $sdk->getCkts();

// 企业采集客户端
$collectClient = $sdk->getCollect();

// 风险查询客户端
$riskClient = $sdk->getRisk();

// 企业洞察客户端
$insightClient = $sdk->getInsight();

// 政策法规客户端
$legislationClient = $sdk->getLegislation();
```

## 链式操作

SDK 1.0.0 版本起支持链式操作，提供类型安全的响应对象，使API调用更加直观和易于维护。

### 基本链式操作

```php
// 获取类型化响应
$response = $invoiceClient->queryZzsfpCy($params);

// 链式处理
$response
    ->then(function($data) {
        echo "查询成功\n";
        return processData($data);
    })
    ->catch(function($error, $statusCode) {
        echo "查询失败: " . $error . " (状态码: " . $statusCode . ")\n";
    })
    ->finally(function($response) {
        echo "操作完成\n";
    });
```

### 类型化数据处理

```php
// 发票数据处理
$response->processInvoice(function($invoiceData) {
    echo "发票代码: " . $invoiceData['code'] . "\n";
    echo "发票金额: " . number_format($invoiceData['amount'], 2) . "\n";
    
    return $invoiceData;
});

// 企业数据处理
$response->processOrg(function($orgData) {
    echo "企业名称: " . $orgData['name'] . "\n";
    echo "统一社会信用代码: " . $orgData['creditCode'] . "\n";
    
    return $orgData;
});
```

### 多级链式操作

```php
// 先查询企业信息，然后根据企业信息查询发票
$orgClient->getOrgInfo(['orgId' => $orgId])
    ->processOrg(function($orgData) use ($invoiceClient) {
        if ($orgData['status'] === 'active') {
            return $invoiceClient->queryPtfpCy($invoiceParams);
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

### 类型安全操作

```php
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
    
    return [
        'id' => $productId,
        'price' => $price,
        'isActive' => $isActive
    ];
});
```

更多链式操作示例和最佳实践请参考：
- [CHAIN_OPERATIONS.md](CHAIN_OPERATIONS.md) - 链式操作完整指南
- [examples/chained_operations_example.php](examples/chained_operations_example.php) - 链式操作使用示例
- [examples/chained_operations_test.php](examples/chained_operations_test.php) - 链式操作测试示例

## 配置选项

| 配置项 | 类型 | 必填 | 默认值 | 说明 |
|--------|------|------|--------|------|
| appKey | string | 是 | - | 应用 Key |
| apiHost | string | 是 | - | API 主机地址 |
| appSecret | string | 是 | - | 应用密钥 |
| timeout | int | 否 | 30 | 请求超时时间（秒） |
| enableCache | bool | 否 | true | 是否启用 Token 缓存 |
| cacheDir | string | 否 | ./cache | 缓存目录 |
| maxRetries | int | 否 | 3 | 最大重试次数 |
| retryDelay | int | 否 | 1000 | 重试延迟（毫秒） |
| enableLog | bool | 否 | true | 是否启用日志 |
| logLevel | string | 否 | info | 日志级别 |

## 业务客户端

SDK 提供以下业务客户端，推荐使用便捷的 `get` 方法获取：

### 1. 发票客户端 (InvoiceClient)
发票查验、查询等业务

```php
// 推荐使用
$invoiceClient = $sdk->getInvoice();

// 或使用通用方法
// $invoiceClient = $sdk->getClient('invoice');

// 增值税发票查验
$result = $invoiceClient->queryZzsfpCy($params);

// 数电票查验
$result = $invoiceClient->queryDigitalInvoice($params);
```

### 2. 企业管理客户端 (OrgClient)
企业信息管理

```php
$orgClient = $sdk->getOrg();

// 创建企业
$result = $orgClient->create($params);

// 查询企业列表
$result = $orgClient->list($params);
```

### 3. 账号管理客户端 (AccountClient)
账号管理相关业务

```php
$accountClient = $sdk->getAccount();

// 创建账号
$result = $accountClient->create($params);

// 查询账号
$result = $accountClient->query($params);
```

### 4. 登录客户端 (LoginClient)
登录相关业务

```php
$loginClient = $sdk->getLogin();

// 账号密码登录
$result = $loginClient->password($params);

// 短信验证码登录
$result = $loginClient->sms($params);

// 扫码登录
$result = $loginClient->qrcode($params);
```

### 5. 税务申报客户端 (TaxClient)
税务申报业务

```php
$taxClient = $sdk->getTax();

// 提交申报
$result = $taxClient->submit($params);

// 查询申报结果
$result = $taxClient->query($params);
```

### 6. 个税客户端 (IitClient)
个人所得税相关业务

```php
$iitClient = $sdk->getIit();

// 查询个税信息
$result = $iitClient->query($params);

// 提交个税申报
$result = $iitClient->submit($params);
```

### 7. 办税人员管理客户端 (BsryglClient)
办税人员管理业务

```php
$bsryglClient = $sdk->getBsrygl();

// 添加办税人员
$result = $bsryglClient->addBsyTask($params);

// 查询办税人员
$result = $bsryglClient->queryBsyTask($params);
```

### 8. 产品管理客户端 (ProductClient)
产品订购管理

```php
$productClient = $sdk->getProduct();

// 订购产品
$result = $productClient->purchase($params);

// 查询订单
$result = $productClient->list($params);
```

### 9. 企业信息采集客户端 (OrgInfoClient)
企业信息采集

```php
$orgInfoClient = $sdk->getOrgInfo();

// 发起采集任务
$result = $orgInfoClient->beginTask($params);

// 查询采集结果
$result = $orgInfoClient->queryTask($params);
```

### 10. 消息客户端 (MessageClient)
消息通知管理

```php
$messageClient = $sdk->getMessage();

// 获取通知
$result = $messageClient->getNotice($params);

// 标记已读
$result = $messageClient->markAsRead($params);
```

### 11. 办税小号客户端 (PhoneClient)
办税小号业务

```php
$phoneClient = $sdk->getPhone();

// 申请小号
$result = $phoneClient->createOrder($params);

// 绑定手机号
$result = $phoneClient->bind($params);
```

### 12. 前台发票客户端 (QdfpClient)
前台发票业务

```php
$qdfpClient = $sdk->getQdfp();

// 红字发票开具
$result = $qdfpClient->createRedInvoice($params);

// 查询发票
$result = $qdfpClient->queryInvoiceList($params);
```

### 13. 商品信息客户端 (SpxxClient)
商品信息管理

```php
$spxxClient = $sdk->getSpxx();

// 新增商品
$result = $spxxClient->addProduct($params);

// 查询商品
$result = $spxxClient->queryProductList($params);
```

### 14. 客户信息客户端 (KhxxClient)
客户信息管理

```php
$khxxClient = $sdk->getKhxx();

// 新增客户
$result = $khxxClient->addCustomer($params);

// 查询客户
$result = $khxxClient->queryCustomerList($params);
```

### 15. 认证客户端 (RzClient)
认证相关业务

```php
$rzClient = $sdk->getRz();

// 进项发票采集
$result = $rzClient->applyInputInvoiceCollect($params);

// 查询采集结果
$result = $rzClient->queryInputInvoiceResult($params);
```

### 16. 文件版式下载客户端 (SdFileClient)
文件版式下载业务

```php
$sdFileClient = $sdk->getSdFile();

// 下载文件
$result = $sdFileClient->download($params);
```

### 17. 发票入账客户端 (FpruzClient)
发票入账业务

```php
$fpruzClient = $sdk->getFpruz();

// 发票入账
$result = $fpruzClient->accounting($params);
```

### 18. 发票归集客户端 (GjClient)
发票归集业务

```php
$gjClient = $sdk->getGj();

// 发票归集
$result = $gjClient->collect($params);
```

### 19. 企业税务信息客户端 (OrgTaxInfoClient)
企业税务信息业务

```php
$orgTaxInfoClient = $sdk->getOrgTaxInfo();

// 查询税务信息
$result = $orgTaxInfoClient->query($params);
```

### 20. 企业税种客户端 (QysClient)
企业税种业务

```php
$qysClient = $sdk->getQys();

// 查询税种信息
$result = $qysClient->query($params);
```

### 21. 生产经营所得客户端 (ScjyClient)
生产经营所得业务

```php
$scjyClient = $sdk->getScjy();

// 查询所得信息
$result = $scjyClient->query($params);
```

### 22. 社保客户端 (ShbxClient)
社保业务

```php
$shbxClient = $sdk->getShbx();

// 查询社保信息
$result = $shbxClient->query($params);
```

### 23. 海关客户端 (CustomsClient)
海关业务

```php
$customsClient = $sdk->getCustoms();

// 查询海关信息
$result = $customsClient->query($params);
```

### 24. 出口退税客户端 (CktsClient)
出口退税业务

```php
$cktsClient = $sdk->getCkts();

// 出口退税
$result = $cktsClient->refund($params);
```

### 25. 企业采集客户端 (CollectClient)
企业采集业务

```php
$collectClient = $sdk->getCollect();

// 企业采集
$result = $collectClient->collect($params);
```

### 26. 风险查询客户端 (RiskClient)
风险查询业务

```php
$riskClient = $sdk->getRisk();

// 查询风险信息
$result = $riskClient->query($params);
```

### 27. 企业洞察客户端 (InsightClient)
企业洞察业务

```php
$insightClient = $sdk->getInsight();

// 企业洞察分析
$result = $insightClient->analyze($params);
```

### 28. 政策法规客户端 (LegislationClient)
政策法规业务

```php
$legislationClient = $sdk->getLegislation();

// 查询政策法规
$result = $legislationClient->query($params);
```

## 错误处理

SDK 提供完整的异常处理机制：

```php
use QixiangyunSDK\Exceptions\QixiangyunException;
use QixiangyunSDK\Exceptions\AuthTokenException;

try {
    $result = $client->method($params);
} catch (AuthTokenException $e) {
    // 认证错误
    echo "认证失败: " . $e->getMessage();
} catch (QixiangyunException $e) {
    // API 错误
    echo "API 错误: " . $e->getMessage();
    echo "错误码: " . $e->getCode();
    echo "响应数据: " . print_r($e->getResponseData(), true);
}
```

## 高级功能

### 自定义客户端

您可以注册自定义客户端：

```php
// 创建自定义客户端
class CustomClient extends BaseClient
{
    protected $clientName = 'custom';
    
    public function customMethod(array $params)
    {
        return $this->request('/custom/path', $params);
    }
}

// 注册自定义客户端
$sdk->getClientFactory()->registerClient('custom', CustomClient::class);

// 使用自定义客户端
$customClient = $sdk->getClient('custom');
$result = $customClient->customMethod($params);
```

### 更新配置

```php
// 更新 SDK 配置
$sdk->updateConfig([
    'timeout' => 60,
    'maxRetries' => 5
]);
```

### 直接访问 HTTP 客户端

```php
// 获取 HTTP 客户端实例
$httpClient = $sdk->getHttpClient();

// 自定义请求
$response = $httpClient->request('GET', '/custom/path', $params);
```

## 项目结构

```
Qixiangyun/
├── src/
│   ├── autoload.php              # 自动加载器
│   ├── SDK.php                   # SDK 主类
│   ├── Core/
│   │   ├── Config.php           # 配置类
│   │   ├── HttpClient.php       # HTTP 客户端
│   │   ├── BaseClient.php       # 基础客户端
│   │   ├── ClientFactory.php    # 客户端工厂
│   │   ├── Response.php         # 响应基类
│   │   └── ResponseBuilder.php  # 响应构建器
│   ├── Core/Types/              # 类型化响应类
│   │   ├── BaseResponse.php    # 基础响应
│   │   ├── InvoiceResponse.php # 发票响应
│   │   ├── OrgResponse.php     # 企业响应
│   │   ├── TaxResponse.php     # 税务响应
│   │   └── ...                 # 其他响应类
│   ├── Clients/                  # 业务客户端
│   │   ├── InvoiceClient.php   # 发票客户端
│   │   ├── OrgClient.php       # 企业客户端
│   │   ├── AccountClient.php   # 账号客户端
│   │   ├── LoginClient.php     # 登录客户端
│   │   ├── TaxClient.php       # 税务客户端
│   │   ├── IitClient.php       # 个税客户端
│   │   ├── BsryglClient.php   # 办税人员管理
│   │   ├── ProductClient.php   # 产品管理
│   │   ├── OrgInfoClient.php   # 企业信息采集
│   │   ├── MessageClient.php   # 消息通知
│   │   ├── PhoneClient.php     # 办税小号
│   │   ├── QdfpClient.php      # 前台发票
│   │   ├── SpxxClient.php      # 商品信息
│   │   ├── KhxxClient.php      # 客户信息
│   │   ├── RzClient.php        # 认证客户端
│   │   ├── SdFileClient.php    # 文件版式下载
│   │   ├── FpruzClient.php     # 发票入账
│   │   ├── GjClient.php        # 发票归集
│   │   ├── OrgTaxInfoClient.php # 企业税务信息
│   │   ├── QysClient.php       # 企业税种
│   │   ├── ScjyClient.php      # 生产经营所得
│   │   ├── ShbxClient.php      # 社保
│   │   ├── CustomsClient.php   # 海关
│   │   ├── CktsClient.php      # 出口退税
│   │   ├── CollectClient.php   # 企业采集
│   │   ├── RiskClient.php      # 风险查询
│   │   ├── InsightClient.php   # 企业洞察
│   │   └── LegislationClient.php # 政策法规
│   └── Exceptions/              # 异常类
│       ├── QixiangyunException.php
│       └── AuthTokenException.php
├── examples/                    # 使用示例
│   ├── complete_example.php
│   ├── invoice_example.php
│   ├── login_example.php
│   └── error_handling_example.php
├── tests/                       # 测试文件
├── composer.json               # Composer 配置
└── README.md                   # 项目文档
```

## 系统要求

- PHP >= 7.4
- curl 扩展
- json 扩展
- mbstring 扩展

## 示例代码

完整的示例代码请参考 [examples](examples) 目录。

## 许可证

MIT License

## 支持

如有问题，请联系技术支持或提交 Issue。
