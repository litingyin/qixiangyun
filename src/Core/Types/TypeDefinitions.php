<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 类型定义文档
 * 定义所有API响应类型和链式操作方法
 */

/**
 * 基础响应类型
 * 
 * 所有响应类型都继承自基础Response类，提供以下公共方法：
 * - getData(): array - 获取原始响应数据
 * - get(string $key, $default = null): mixed - 获取指定键的数据
 * - isSuccess(): bool - 检查响应是否成功
 * - getError(): ?string - 获取错误信息
 * - getStatusCode(): int - 获取HTTP状态码
 * - toArray(): array - 转换为数组
 * - toJson(): string - 转换为JSON
 * - then(callable $callback): mixed - 链式调用：成功时执行回调
 * - catch(callable $callback): self - 链式调用：失败时执行回调
 * - finally(callable $callback): self - 链式调用：无论成功失败都执行回调
 */

/**
 * 发票响应类型 - InvoiceResponse
 * 
 * 提供发票相关API的返回值类型定义和方法：
 * - getInvoiceCode(): string - 获取发票代码
 * - getInvoiceNumber(): string - 获取发票号码
 * - getInvoiceDate(): string - 获取开票日期
 * - getAmount(): float - 获取发票金额
 * - getInvoiceType(): string - 获取发票类型
 * - getPurchaserName(): string - 获取购买方名称
 * - getSellerName(): string - 获取销售方名称
 * - isValid(): bool - 检查发票是否有效
 * - processInvoice(callable $callback): self - 链式操作：获取发票信息并继续处理
 * 
 * 使用示例：
 * $response = $invoiceClient->queryInvoice($params);
 * $response->processInvoice(function($invoiceData, $response) {
 *     echo "发票代码: " . $invoiceData['code'];
 *     return $response;
 * });
 */

/**
 * 企业信息响应类型 - OrgResponse
 * 
 * 提供企业相关API的返回值类型定义和方法：
 * - getaggOrgId(): string - 获取企业ID
 * - getOrgName(): string - 获取企业名称
 * - getCreditCode(): string - 获取统一社会信用代码
 * - getLegalRepresentative(): string - 获取法定代表人
 * - getAddress(): string - 获取注册地址
 * - getPhone(): string - 获取联系电话
 * - getBusinessScope(): string - 获取经营范围
 * - getEstablishDate(): string - 获取成立日期
 * - getStatus(): string - 获取企业状态
 * - isValid(): bool - 检查企业信息是否有效
 * - processOrg(callable $callback): self - 链式操作：获取企业信息并继续处理
 * 
 * 使用示例：
 * $response = $orgClient->getOrgInfo($params);
 * $response->processOrg(function($orgData, $response) {
 *     echo "企业名称: " . $orgData['name'];
 *     return $response;
 * });
 */

/**
 * 税务申报响应类型 - TaxResponse
 * 
 * 提供税务申报相关API的返回值类型定义和方法：
 * - getTaskId(): string - 获取申报任务ID
 * - getStatus(): string - 获取申报状态
 * - getTaxPeriod(): string - 获取申报期间
 * - getTaxType(): string - 获取税种
 * - getTaxAmount(): float - 获取应缴税额
 * - getPaidAmount(): float - 获取已缴税额
 * - getResult(): array - 获取申报结果
 * - getTaxFormData(): array - 获取申报表数据
 * - isDeclarationSuccess(): bool - 检查申报是否成功
 * - hasTaxToPay(): bool - 检查是否需要补缴税款
 * - processDeclaration(callable $callback): self - 链式操作：获取申报信息并继续处理
 * 
 * 使用示例：
 * $response = $taxClient->declareTax($params);
 * $response->processDeclaration(function($declarationData, $response) {
 *     if ($declarationData['hasTaxToPay']) {
 *         echo "需要缴税: " . $declarationData['taxAmount'];
 *     }
 *     return $response;
 * });
 */

/**
 * 产品管理响应类型 - ProductResponse
 * 
 * 提供产品管理相关API的返回值类型定义和方法：
 * - getProductId(): string - 获取产品ID
 * - getProductName(): string - 获取产品名称
 * - getProductCode(): string - 获取产品代码
 * - getPrice(): float - 获取产品价格
 * - getDescription(): string - 获取产品描述
 * - getStatus(): string - 获取产品状态
 * - getCreateTime(): string - 获取创建时间
 * - getUpdateTime(): string - 获取更新时间
 * - isValid(): bool - 检查产品是否有效
 * - isActive(): bool - 检查产品是否激活
 * - processProduct(callable $callback): self - 链式操作：获取产品信息并继续处理
 * 
 * 使用示例：
 * $response = $productClient->getProduct($params);
 * $response->processProduct(function($productData, $response) {
 *     echo "产品名称: " . $productData['name'];
 *     if ($productData['isActive']) {
 *         echo "产品已激活";
 *     }
 *     return $response;
 * });
 */

/**
 * 账户管理响应类型 - AccountResponse
 * 
 * 提供账户管理相关API的返回值类型定义和方法：
 * - getAccountId(): string - 获取账户ID
 * - getUsername(): string - 获取用户名
 * - getAccountType(): string - 获取账户类型
 * - getStatus(): string - 获取账户状态
 * - getaggOrgIds(): array - 获取企业ID列表
 * - getRole(): string - 获取角色
 * - getPermissions(): array - 获取权限列表
 * - getCreateTime(): string - 获取创建时间
 * - getLastLoginTime(): string - 获取最后登录时间
 * - isValid(): bool - 检查账户是否有效
 * - isActive(): bool - 检查账户是否激活
 * - hasPermission(string $permission): bool - 检查是否有指定权限
 * - processAccount(callable $callback): self - 链式操作：获取账户信息并继续处理
 * 
 * 使用示例：
 * $response = $accountClient->getAccountInfo($params);
 * $response->processAccount(function($accountData, $response) {
 *     echo "用户名: " . $accountData['username'];
 *     if ($accountData['hasPermission']('admin')) {
 *         echo "具有管理员权限";
 *     }
 *     return $response;
 * });
 */

/**
 * 链式操作最佳实践
 * 
 * 1. 链式条件处理：
 *    $response->then(function($data) {
 *        // 成功处理
 *    })->catch(function($error) {
 *        // 错误处理
 *    });
 * 
 * 2. 链式数据转换：
 *    $response->processInvoice(function($invoiceData) {
 *        $invoiceData['formattedAmount'] = number_format($invoiceData['amount'], 2);
 *        return $invoiceData;
 *    });
 * 
 * 3. 链式验证：
 *    $response->processOrg(function($orgData) {
 *        if (empty($orgData['creditCode'])) {
 *            throw new \Exception("企业信用代码不能为空");
 *        }
 *        return $orgData;
 *    });
 * 
 * 4. 链式日志记录：
 *    $response->finally(function($response) {
 *        if ($response->isSuccess()) {
 *            error_log("操作成功: " . json_encode($response->getData()));
 *        } else {
 *            error_log("操作失败: " . $response->getError());
 *        }
 *    });
 */