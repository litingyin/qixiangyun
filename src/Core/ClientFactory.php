<?php

namespace QixiangyunSDK\Core;

use QixiangyunSDK\Core\Config;
use QixiangyunSDK\Core\BaseClient;

class ClientFactory
{
    /**
     * SDK配置
     *
     * @var Config
     */
    protected $config;
    
    /**
     * 客户端注册表
     *
     * @var array
     */
    protected $clientRegistry = [];
    
    /**
     * 客户端实例缓存
     *
     * @var array
     */
    protected $clientInstances = [];
    
    /**
     * 构造函数
     *
     * @param Config $config SDK配置
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->registerDefaultClients();
    }
    
    /**
     * 注册客户端类
     *
     * @param string $clientType 客户端类型
     * @param string $clientClass 客户端类名（必须继承自BaseClient）
     * @return void
     * @throws \Exception
     */
    public function registerClient(string $clientType, string $clientClass): void
    {
        // 验证类是否存在
        if (!class_exists($clientClass)) {
            throw new \Exception("Client class '{$clientClass}' does not exist");
        }
        
        // 验证类是否继承自BaseClient
        if (!is_subclass_of($clientClass, BaseClient::class)) {
            throw new \Exception("Client class '{$clientClass}' must extend BaseClient");
        }
        
        $this->clientRegistry[$clientType] = $clientClass;
    }
    
    /**
     * 创建客户端实例（单例模式）
     *
     * @param string $clientType 客户端类型
     * @return BaseClient
     * @throws \Exception
     */
    public function createClient(string $clientType): BaseClient
    {
        // 检查是否已有实例
        if (isset($this->clientInstances[$clientType])) {
            return $this->clientInstances[$clientType];
        }
        
        // 检查客户端类型是否已注册
        if (!isset($this->clientRegistry[$clientType])) {
            throw new \Exception("Unknown client type: {$clientType}");
        }
        
        // 创建新实例
        $clientClass = $this->clientRegistry[$clientType];
        $instance = new $clientClass($this->config);
        
        // 缓存实例
        $this->clientInstances[$clientType] = $instance;
        
        return $instance;
    }
    
    /**
     * 获取所有已注册的客户端类型
     *
     * @return array
     */
    public function getRegisteredClientTypes(): array
    {
        return array_keys($this->clientRegistry);
    }
    
    /**
     * 销毁所有客户端实例
     *
     * @return void
     */
    public function destroy(): void
    {
        $this->clientInstances = [];
    }
    
    /**
     * 注册默认客户端
     *
     * @return void
     */
    protected function registerDefaultClients(): void
    {
        // 发票客户端
        $this->registerClient('invoice', 'QixiangyunSDK\\Clients\\InvoiceClient');
        
        // 企业管理客户端
        $this->registerClient('org', 'QixiangyunSDK\\Clients\\OrgClient');
        
        // 账号管理客户端
        $this->registerClient('account', 'QixiangyunSDK\\Clients\\AccountClient');
        
        // 登录客户端
        $this->registerClient('login', 'QixiangyunSDK\\Clients\\LoginClient');
        
        // 税务申报客户端
        $this->registerClient('tax', 'QixiangyunSDK\\Clients\\TaxClient');
        
        // 个税客户端
        $this->registerClient('iit', 'QixiangyunSDK\\Clients\\IitClient');
        
        // 办税人员管理客户端
        $this->registerClient('bsrygl', 'QixiangyunSDK\\Clients\\BsryglClient');
        
        // 产品管理客户端
        $this->registerClient('product', 'QixiangyunSDK\\Clients\\ProductClient');
        
        // 企业信息采集客户端
        $this->registerClient('orginfo', 'QixiangyunSDK\\Clients\\OrgInfoClient');
        
        // 消息客户端
        $this->registerClient('message', 'QixiangyunSDK\\Clients\\MessageClient');
        
        // 办税小号客户端
        $this->registerClient('phone', 'QixiangyunSDK\\Clients\\PhoneClient');
        
        // 前台发票客户端
        $this->registerClient('qdfp', 'QixiangyunSDK\\Clients\\QdfpClient');
        
        // 商品信息客户端
        $this->registerClient('spxx', 'QixiangyunSDK\\Clients\\SpxxClient');
        
        // 客户信息客户端
        $this->registerClient('khxx', 'QixiangyunSDK\\Clients\\KhxxClient');
        
        // 认证客户端
        $this->registerClient('rz', 'QixiangyunSDK\\Clients\\RzClient');
        
        // 文件版式下载客户端
        $this->registerClient('sdfile', 'QixiangyunSDK\\Clients\\SdFileClient');
        
        // 发票入账客户端
        $this->registerClient('fpruz', 'QixiangyunSDK\\Clients\\FpruzClient');
        
        // 发票归集客户端
        $this->registerClient('gj', 'QixiangyunSDK\\Clients\\GjClient');
        
        // 企业税务信息客户端
        $this->registerClient('orgtaxinfo', 'QixiangyunSDK\\Clients\\OrgTaxInfoClient');
        
        // 企业税种客户端
        $this->registerClient('qys', 'QixiangyunSDK\\Clients\\QysClient');
        
        // 生产经营所得客户端
        $this->registerClient('scjy', 'QixiangyunSDK\\Clients\\ScjyClient');
        
        // 社保客户端
        $this->registerClient('shbx', 'QixiangyunSDK\\Clients\\ShbxClient');
        
        // 海关客户端
        $this->registerClient('customs', 'QixiangyunSDK\\Clients\\CustomsClient');
        
        // 出口退税客户端
        $this->registerClient('ckts', 'QixiangyunSDK\\Clients\\CktsClient');
        
        // 企业采集客户端
        $this->registerClient('collect', 'QixiangyunSDK\\Clients\\CollectClient');
        
        // 风险查询客户端
        $this->registerClient('risk', 'QixiangyunSDK\\Clients\\RiskClient');
        
        // 企业洞察客户端
        $this->registerClient('insight', 'QixiangyunSDK\\Clients\\InsightClient');
        
        // 政策法规客户端
        $this->registerClient('legislation', 'QixiangyunSDK\\Clients\\LegislationClient');
    }
    
    /**
     * 清除所有客户端注册-推送一下
     *
     * @return void
     */
    public function clearClientRegistry(): void
    {
        $this->clientRegistry = [];
        $this->clientInstances = [];
    }
}