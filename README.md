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

// 2. 获取业务客户端
$invoiceClient = $sdk->getClient('invoice');

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

SDK 提供以下业务客户端：

### 1. 发票客户端 (InvoiceClient)
发票查验、查询等业务

```php
$invoiceClient = $sdk->getClient('invoice');

// 增值税发票查验
$result = $invoiceClient->queryZzsfpCy($params);

// 数电票查验
$result = $invoiceClient->queryDigitalInvoice($params);
```

### 2. 企业管理客户端 (OrgClient)
企业信息管理

```php
$orgClient = $sdk->getClient('org');

// 创建企业
$result = $orgClient->create($params);

// 查询企业列表
$result = $orgClient->list($params);
```

### 3. 账号管理客户端 (AccountClient)
账号管理相关业务

```php
$accountClient = $sdk->getClient('account');

// 创建账号
$result = $accountClient->create($params);

// 查询账号
$result = $accountClient->query($params);
```

### 4. 登录客户端 (LoginClient)
登录相关业务

```php
$loginClient = $sdk->getClient('login');

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
$taxClient = $sdk->getClient('tax');

// 提交申报
$result = $taxClient->submit($params);

// 查询申报结果
$result = $taxClient->query($params);
```

### 6. 个税客户端 (IitClient)
个人所得税相关业务

```php
$iitClient = $sdk->getClient('iit');

// 查询个税信息
$result = $iitClient->query($params);

// 提交个税申报
$result = $iitClient->submit($params);
```

### 7. 办税人员管理客户端 (BsryglClient)
办税人员管理业务

```php
$bsryglClient = $sdk->getClient('bsrygl');

// 添加办税人员
$result = $bsryglClient->addBsyTask($params);

// 查询办税人员
$result = $bsryglClient->queryBsyTask($params);
```

### 8. 产品管理客户端 (ProductClient)
产品订购管理

```php
$productClient = $sdk->getClient('product');

// 订购产品
$result = $productClient->purchase($params);

// 查询订单
$result = $productClient->list($params);
```

### 9. 企业信息采集客户端 (OrgInfoClient)
企业信息采集

```php
$orgInfoClient = $sdk->getClient('orginfo');

// 发起采集任务
$result = $orgInfoClient->beginTask($params);

// 查询采集结果
$result = $orgInfoClient->queryTask($params);
```

### 10. 消息客户端 (MessageClient)
消息通知管理

```php
$messageClient = $sdk->getClient('message');

// 获取通知
$result = $messageClient->getNotice($params);

// 标记已读
$result = $messageClient->markAsRead($params);
```

### 11. 办税小号客户端 (PhoneClient)
办税小号业务

```php
$phoneClient = $sdk->getClient('phone');

// 申请小号
$result = $phoneClient->createOrder($params);

// 绑定手机号
$result = $phoneClient->bind($params);
```

### 12. 前台发票客户端 (QdfpClient)
前台发票业务

```php
$qdfpClient = $sdk->getClient('qdfp');

// 红字发票开具
$result = $qdfpClient->createRedInvoice($params);

// 查询发票
$result = $qdfpClient->queryInvoiceList($params);
```

### 13. 商品信息客户端 (SpxxClient)
商品信息管理

```php
$spxxClient = $sdk->getClient('spxx');

// 新增商品
$result = $spxxClient->addProduct($params);

// 查询商品
$result = $spxxClient->queryProductList($params);
```

### 14. 客户信息客户端 (KhxxClient)
客户信息管理

```php
$khxxClient = $sdk->getClient('khxx');

// 新增客户
$result = $khxxClient->addCustomer($params);

// 查询客户
$result = $khxxClient->queryCustomerList($params);
```

### 15. 认证客户端 (RzClient)
认证相关业务

```php
$rzClient = $sdk->getClient('rz');

// 进项发票采集
$result = $rzClient->applyInputInvoiceCollect($params);

// 查询采集结果
$result = $rzClient->queryInputInvoiceResult($params);
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
│   │   └── ClientFactory.php    # 客户端工厂
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
│   │   └── RzClient.php        # 认证客户端
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
