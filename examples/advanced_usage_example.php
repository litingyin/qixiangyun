<?php
/**
 * 企享云 SDK 高级功能使用示例
 * 展示所有客户端的基本用法
 */

require_once __DIR__ . '/../src/autoload.php';

use QixiangyunSDK\SDK;

try {
    // 1. 初始化 SDK
    $sdk = SDK::create([
        'appKey' => 'your_app_key',
        'apiHost' => 'https://api.qixiangyun.com',
        'appSecret' => 'your_app_secret',
        'timeout' => 30,
        'enableCache' => true,
        'cacheDir' => __DIR__ . '/cache'
    ]);
    
    // 2. 获取所有已注册的客户端类型
    $clientTypes = $sdk->getClientFactory()->getRegisteredClientTypes();
    echo "已注册的客户端类型:\n";
    print_r($clientTypes);
    
    // 3. 基础客户端使用示例
    echo "\n=== 基础客户端使用示例 ===\n";
    
    // 发票客户端
    $invoiceClient = $sdk->getClient('invoice');
    echo "发票客户端创建成功\n";
    
    // 企业管理客户端
    $orgClient = $sdk->getClient('org');
    echo "企业管理客户端创建成功\n";
    
    // 账号管理客户端
    $accountClient = $sdk->getClient('account');
    echo "账号管理客户端创建成功\n";
    
    // 登录客户端
    $loginClient = $sdk->getClient('login');
    echo "登录客户端创建成功\n";
    
    // 税务申报客户端
    $taxClient = $sdk->getClient('tax');
    echo "税务申报客户端创建成功\n";
    
    // 个税客户端
    $iitClient = $sdk->getClient('iit');
    echo "个税客户端创建成功\n";
    
    // 4. 扩展客户端使用示例
    echo "\n=== 扩展客户端使用示例 ===\n";
    
    // 办税人员管理客户端
    $bsryglClient = $sdk->getClient('bsrygl');
    echo "办税人员管理客户端创建成功\n";
    
    // 产品管理客户端
    $productClient = $sdk->getClient('product');
    echo "产品管理客户端创建成功\n";
    
    // 企业信息采集客户端
    $orgInfoClient = $sdk->getClient('orginfo');
    echo "企业信息采集客户端创建成功\n";
    
    // 消息客户端
    $messageClient = $sdk->getClient('message');
    echo "消息客户端创建成功\n";
    
    // 办税小号客户端
    $phoneClient = $sdk->getClient('phone');
    echo "办税小号客户端创建成功\n";
    
    // 前台发票客户端
    $qdfpClient = $sdk->getClient('qdfp');
    echo "前台发票客户端创建成功\n";
    
    // 商品信息客户端
    $spxxClient = $sdk->getClient('spxx');
    echo "商品信息客户端创建成功\n";
    
    // 客户信息客户端
    $khxxClient = $sdk->getClient('khxx');
    echo "客户信息客户端创建成功\n";
    
    // 认证客户端
    $rzClient = $sdk->getClient('rz');
    echo "认证客户端创建成功\n";
    
    // 5. 新增高级客户端使用示例
    echo "\n=== 新增高级客户端使用示例 ===\n";
    
    // 文件版式下载客户端
    $sdFileClient = $sdk->getClient('sdfile');
    echo "文件版式下载客户端创建成功\n";
    
    // 发票入账客户端
    $fpruzClient = $sdk->getClient('fpruz');
    echo "发票入账客户端创建成功\n";
    
    // 发票归集客户端
    $gjClient = $sdk->getClient('gj');
    echo "发票归集客户端创建成功\n";
    
    // 企业税务信息客户端
    $orgTaxInfoClient = $sdk->getClient('orgtaxinfo');
    echo "企业税务信息客户端创建成功\n";
    
    // 企业税种客户端
    $qysClient = $sdk->getClient('qys');
    echo "企业税种客户端创建成功\n";
    
    // 生产经营所得客户端
    $scjyClient = $sdk->getClient('scjy');
    echo "生产经营所得客户端创建成功\n";
    
    // 社保客户端
    $shbxClient = $sdk->getClient('shbx');
    echo "社保客户端创建成功\n";
    
    // 海关客户端
    $customsClient = $sdk->getClient('customs');
    echo "海关客户端创建成功\n";
    
    // 出口退税客户端
    $cktsClient = $sdk->getClient('ckts');
    echo "出口退税客户端创建成功\n";
    
    // 企业采集客户端
    $collectClient = $sdk->getClient('collect');
    echo "企业采集客户端创建成功\n";
    
    // 风险查询客户端
    $riskClient = $sdk->getClient('risk');
    echo "风险查询客户端创建成功\n";
    
    // 企业洞察客户端
    $insightClient = $sdk->getClient('insight');
    echo "企业洞察客户端创建成功\n";
    
    // 政策法规客户端
    $legislationClient = $sdk->getClient('legislation');
    echo "政策法规客户端创建成功\n";
    
    // 6. 实际API调用示例
    echo "\n=== 实际API调用示例 ===\n";
    
    // 使用发票客户端查询发票
    try {
        $result = $invoiceClient->queryZzsfpCy([
            [
                "fpdm" => "044031800104",
                "fphm" => "12345678",
                "kprq" => "2024-01-01",
                "je" => 1000.00
            ]
        ]);
        
        echo "发票查询结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "发票查询失败: " . $e->getMessage() . "\n";
    }
    
    // 使用企业客户端创建企业
    try {
        $result = $orgClient->create([
            'orgName' => '测试企业',
            'orgType' => '1',
            'nsrsbh' => '91110000000000000X'
        ]);
        
        echo "企业创建结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "企业创建失败: " . $e->getMessage() . "\n";
    }
    
    // 使用登录客户端进行账号密码登录
    try {
        $result = $loginClient->password([
            'aggOrgId' => 'your_org_id',
            'username' => 'your_username',
            'password' => 'your_password',
            'taxType' => '1'
        ]);
        
        echo "登录结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "登录失败: " . $e->getMessage() . "\n";
    }
    
    // 使用文件版式下载客户端发起获取数电版式任务
    try {
        $result = $sdFileClient->applyLayoutFile([
            'aggOrgId' => 'your_org_id',
            'fpdm' => 'your_fpdm',
            'fphm' => 'your_fphm'
        ]);
        
        echo "发起获取数电版式任务结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "发起获取数电版式任务失败: " . $e->getMessage() . "\n";
    }
    
    // 使用企业洞察客户端查询企业基本信息
    try {
        $result = $insightClient->info([
            'aggOrgId' => 'your_org_id'
        ]);
        
        echo "企业基本信息查询结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "企业基本信息查询失败: " . $e->getMessage() . "\n";
    }
    
    // 使用政策法规客户端查询政策分类
    try {
        $result = $legislationClient->category([]);
        
        echo "政策分类查询结果:\n";
        print_r($result);
    } catch (Exception $e) {
        echo "政策分类查询失败: " . $e->getMessage() . "\n";
    }
    
    echo "\n=== 所有客户端测试完成 ===\n";
    
} catch (Exception $e) {
    echo "SDK初始化或使用过程中发生错误: " . $e->getMessage() . "\n";
    echo "错误堆栈:\n" . $e->getTraceAsString() . "\n";
}