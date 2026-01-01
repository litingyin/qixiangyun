<?php

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\Core\Response;
use QixiangyunSDK\Core\ResponseBuilder;
use QixiangyunSDK\Core\Types\InvoiceResponse;
use QixiangyunSDK\Core\Types\OrgResponse;
use QixiangyunSDK\Core\Types\TaxResponse;
use QixiangyunSDK\Core\Types\ProductResponse;
use QixiangyunSDK\Core\Types\AccountResponse;

// 测试基本响应对象
echo "=== 测试基本响应对象 ===\n";

// 测试成功响应
$successResponse = Response::success(['data' => 'test', 'value' => 123]);
echo "成功响应: " . $successResponse->toJson() . "\n";
echo "是否成功: " . ($successResponse->isSuccess() ? 'true' : 'false') . "\n";
echo "获取数据: " . $successResponse->get('data') . "\n";
echo "获取值: " . $successResponse->get('value') . "\n";

// 测试失败响应
$errorResponse = Response::error('测试错误', ['errorDetail' => '详细错误信息']);
echo "错误响应: " . $errorResponse->toJson() . "\n";
echo "是否成功: " . ($errorResponse->isSuccess() ? 'true' : 'false') . "\n";
echo "错误信息: " . $errorResponse->getError() . "\n";

// 测试链式操作
$successResponse
    ->then(function($data) {
        echo "链式成功处理: " . json_encode($data) . "\n";
        return $data;
    })
    ->catch(function($error) {
        echo "链式错误处理: " . $error . "\n";
    })
    ->finally(function($response) {
        echo "链式最终处理: 完成\n";
    });

$errorResponse
    ->then(function($data) {
        echo "这不应该被执行\n";
        return $data;
    })
    ->catch(function($error) {
        echo "捕获到错误: " . $error . "\n";
    })
    ->finally(function($response) {
        echo "错误处理最终步骤\n\n";
    });

// 测试类型化响应对象
echo "=== 测试类型化响应对象 ===\n";

// 测试发票响应
$invoiceData = [
    'fpdm' => '12345678901234567890',
    'fphm' => '12345678',
    'kprq' => '2023-01-01',
    'je' => '100.00',
    'fplx' => '专票',
    'gmfmc' => '测试购买方',
    'xsfmc' => '测试销售方'
];

$invoiceResponse = ResponseBuilder::invoice($invoiceData);
echo "发票代码: " . $invoiceResponse->getInvoiceCode() . "\n";
echo "发票号码: " . $invoiceResponse->getInvoiceNumber() . "\n";
echo "发票金额: " . $invoiceResponse->getAmount() . "\n";
echo "发票类型: " . $invoiceResponse->getInvoiceType() . "\n";
echo "购买方: " . $invoiceResponse->getPurchaserName() . "\n";
echo "销售方: " . $invoiceResponse->getSellerName() . "\n";
echo "发票是否有效: " . ($invoiceResponse->isValid() ? 'true' : 'false') . "\n";

// 测试发票链式处理
$invoiceResponse
    ->processInvoice(function($invoiceData) {
        echo "链式处理发票数据:\n";
        echo "  代码: " . $invoiceData['code'] . "\n";
        echo "  号码: " . $invoiceData['number'] . "\n";
        echo "  金额: " . number_format($invoiceData['amount'], 2) . "\n";
        return $invoiceData;
    })
    ->catch(function($error) {
        echo "发票处理错误: " . $error . "\n";
    });

// 测试企业响应
echo "\n=== 测试企业响应 ===\n";

$orgData = [
    'aggOrgId' => '123456789',
    'orgName' => '测试企业有限公司',
    'tyshxydm' => '91110000123456789X',
    'fddbr' => '张三',
    'zcdz' => '北京市海淀区测试路123号',
    'lxdh' => '010-12345678',
    'jyfw' => '软件开发、技术咨询',
    'clrq' => '2020-01-01',
    'qyzt' => 'active'
];

$orgResponse = ResponseBuilder::org($orgData);
echo "企业ID: " . $orgResponse->getaggOrgId() . "\n";
echo "企业名称: " . $orgResponse->getOrgName() . "\n";
echo "统一社会信用代码: " . $orgResponse->getCreditCode() . "\n";
echo "法定代表人: " . $orgResponse->getLegalRepresentative() . "\n";
echo "企业是否有效: " . ($orgResponse->isValid() ? 'true' : 'false') . "\n";

// 测试企业链式处理
$orgResponse
    ->processOrg(function($orgData) {
        echo "链式处理企业数据:\n";
        echo "  ID: " . $orgData['id'] . "\n";
        echo "  名称: " . $orgData['name'] . "\n";
        echo "  信用代码: " . $orgData['creditCode'] . "\n";
        return $orgData;
    })
    ->catch(function($error) {
        echo "企业处理错误: " . $error . "\n";
    });

// 测试税务响应
echo "\n=== 测试税务响应 ===\n";

$taxData = [
    'taskId' => 'TASK123456',
    'status' => 'success',
    'taxPeriod' => '2023-01',
    'taxType' => '增值税',
    'taxAmount' => '1000.00',
    'paidAmount' => '800.00',
    'result' => ['declared' => true, 'approved' => true],
    'taxFormData' => ['field1' => 'value1', 'field2' => 'value2']
];

$taxResponse = ResponseBuilder::tax($taxData);
echo "任务ID: " . $taxResponse->getTaskId() . "\n";
echo "申报状态: " . $taxResponse->getStatus() . "\n";
echo "申报期间: " . $taxResponse->getTaxPeriod() . "\n";
echo "税种: " . $taxResponse->getTaxType() . "\n";
echo "应缴税额: " . $taxResponse->getTaxAmount() . "\n";
echo "已缴税额: " . $taxResponse->getPaidAmount() . "\n";
echo "申报是否成功: " . ($taxResponse->isDeclarationSuccess() ? 'true' : 'false') . "\n";
echo "是否需要补缴税款: " . ($taxResponse->hasTaxToPay() ? 'true' : 'false') . "\n";

// 测试税务链式处理
$taxResponse
    ->processDeclaration(function($declarationData) {
        echo "链式处理申报数据:\n";
        echo "  任务ID: " . $declarationData['taskId'] . "\n";
        echo "  状态: " . $declarationData['status'] . "\n";
        echo "  应缴税额: " . number_format($declarationData['taxAmount'], 2) . "\n";
        echo "  已缴税额: " . number_format($declarationData['paidAmount'], 2) . "\n";
        
        if ($declarationData['hasTaxToPay']) {
            echo "  需要补缴税款: " . number_format($declarationData['taxAmount'] - $declarationData['paidAmount'], 2) . "\n";
        }
        
        return $declarationData;
    })
    ->catch(function($error) {
        echo "申报处理错误: " . $error . "\n";
    });

// 测试产品响应
echo "\n=== 测试产品响应 ===\n";

$productData = [
    'productId' => 'PROD123456',
    'productName' => '测试产品',
    'productCode' => 'TEST001',
    'price' => '99.99',
    'description' => '这是一个测试产品',
    'status' => 'active',
    'createTime' => '2023-01-01 10:00:00',
    'updateTime' => '2023-01-15 15:30:00'
];

$productResponse = ResponseBuilder::product($productData);
echo "产品ID: " . $productResponse->getProductId() . "\n";
echo "产品名称: " . $productResponse->getProductName() . "\n";
echo "产品代码: " . $productResponse->getProductCode() . "\n";
echo "产品价格: " . $productResponse->getPrice() . "\n";
echo "产品描述: " . $productResponse->getDescription() . "\n";
echo "产品状态: " . $productResponse->getStatus() . "\n";
echo "产品是否有效: " . ($productResponse->isValid() ? 'true' : 'false') . "\n";
echo "产品是否激活: " . ($productResponse->isActive() ? 'true' : 'false') . "\n";

// 测试产品链式处理
$productResponse
    ->processProduct(function($productData) {
        echo "链式处理产品数据:\n";
        echo "  ID: " . $productData['id'] . "\n";
        echo "  名称: " . $productData['name'] . "\n";
        echo "  价格: " . number_format($productData['price'], 2) . "\n";
        echo "  状态: " . ($productData['isActive'] ? '激活' : '未激活') . "\n";
        return $productData;
    })
    ->catch(function($error) {
        echo "产品处理错误: " . $error . "\n";
    });

// 测试账户响应
echo "\n=== 测试账户响应 ===\n";

$accountData = [
    'accountId' => 'ACC123456',
    'username' => 'testuser',
    'accountType' => 'admin',
    'status' => 'active',
    'aggOrgIds' => ['ORG001', 'ORG002'],
    'role' => 'manager',
    'permissions' => ['read', 'write', 'delete'],
    'createTime' => '2023-01-01 09:00:00',
    'lastLoginTime' => '2023-01-15 14:30:00'
];

$accountResponse = ResponseBuilder::account($accountData);
echo "账户ID: " . $accountResponse->getAccountId() . "\n";
echo "用户名: " . $accountResponse->getUsername() . "\n";
echo "账户类型: " . $accountResponse->getAccountType() . "\n";
echo "账户状态: " . $accountResponse->getStatus() . "\n";
echo "角色: " . $accountResponse->getRole() . "\n";
echo "权限: " . implode(', ', $accountResponse->getPermissions()) . "\n";
echo "账户是否有效: " . ($accountResponse->isValid() ? 'true' : 'false') . "\n";
echo "账户是否激活: " . ($accountResponse->isActive() ? 'true' : 'false') . "\n";
echo "是否有管理员权限: " . ($accountResponse->hasPermission('admin') ? 'true' : 'false') . "\n";
echo "是否有读取权限: " . ($accountResponse->hasPermission('read') ? 'true' : 'false') . "\n";

// 测试账户链式处理
$accountResponse
    ->processAccount(function($accountData) {
        echo "链式处理账户数据:\n";
        echo "  ID: " . $accountData['id'] . "\n";
        echo "  用户名: " . $accountData['username'] . "\n";
        echo "  角色: " . $accountData['role'] . "\n";
        echo "  权限: " . implode(', ', $accountData['permissions']) . "\n";
        echo "  状态: " . ($accountData['isActive'] ? '激活' : '未激活') . "\n";
        return $accountData;
    })
    ->catch(function($error) {
        echo "账户处理错误: " . $error . "\n";
    });

echo "\n=== 链式操作SDK测试完成 ===\n";