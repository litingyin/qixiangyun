<?php

namespace QixiangyunSDK;

use QixiangyunSDK\Core\Config;
use QixiangyunSDK\Core\ClientFactory;
use QixiangyunSDK\Clients\InvoiceClient;
use QixiangyunSDK\Clients\OrgClient;
use QixiangyunSDK\Clients\AccountClient;
use QixiangyunSDK\Clients\LoginClient;
use QixiangyunSDK\Clients\TaxClient;
use QixiangyunSDK\Clients\IitClient;
use QixiangyunSDK\Clients\BsryglClient;
use QixiangyunSDK\Clients\ProductClient;
use QixiangyunSDK\Clients\OrgInfoClient;
use QixiangyunSDK\Clients\MessageClient;
use QixiangyunSDK\Clients\PhoneClient;
use QixiangyunSDK\Clients\QdfpClient;
use QixiangyunSDK\Clients\SpxxClient;
use QixiangyunSDK\Clients\KhxxClient;
use QixiangyunSDK\Clients\RzClient;
use QixiangyunSDK\Clients\SdFileClient;
use QixiangyunSDK\Clients\FpruzClient;
use QixiangyunSDK\Clients\GjClient;
use QixiangyunSDK\Clients\OrgTaxInfoClient;
use QixiangyunSDK\Clients\QysClient;
use QixiangyunSDK\Clients\ScjyClient;
use QixiangyunSDK\Clients\ShbxClient;
use QixiangyunSDK\Clients\CustomsClient;
use QixiangyunSDK\Clients\CktsClient;
use QixiangyunSDK\Clients\CollectClient;
use QixiangyunSDK\Clients\RiskClient;
use QixiangyunSDK\Clients\InsightClient;
use QixiangyunSDK\Clients\LegislationClient;

class SDK
{
    /**
     * SDK配置
     *
     * @var Config
     */
    protected $config;
    
    /**
     * 客户端工厂
     *
     * @var ClientFactory
     */
    protected $clientFactory;
    
    /**
     * 构造函数
     *
     * @param array $config SDK配置
     *   - appKey: 应用密钥
     *   - apiHost: API主机地址
     *   - appSecret: 应用密钥
     *   - timeout: 请求超时时间（秒）
     *   - enableCache: 是否启用token缓存
     *   - cacheDir: token缓存目录
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->clientFactory = new ClientFactory($this->config);
    }
    
    /**
     * 获取指定类型的客户端
     *
     * @param string $clientType 客户端类型
     * @return mixed
     * @throws \Exception
     */
    public function getClient(string $clientType)
    {
        return $this->clientFactory->createClient($clientType);
    }
    
    /**
     * 获取SDK配置
     *
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
    
    /**
     * 更新配置
     *
     * @param array $config 新配置
     * @return void
     */
    public function updateConfig(array $config): void
    {
        $this->config->update($config);
        $this->clientFactory = new ClientFactory($this->config);
    }
    
    /**
     * 创建SDK实例的静态方法
     *
     * @param array $config SDK配置
     * @return self
     */
    public static function create(array $config): self
    {
        return new self($config);
    }

    /**
     * 获取发票客户端
     *
     * @return InvoiceClient
     */
    public function getInvoice(): InvoiceClient
    {
        return $this->getClient('invoice');
    }

    /**
     * 获取企业管理客户端
     *
     * @return OrgClient
     */
    public function getOrg(): OrgClient
    {
        return $this->getClient('org');
    }

    /**
     * 获取账号管理客户端
     *
     * @return AccountClient
     */
    public function getAccount(): AccountClient
    {
        return $this->getClient('account');
    }

    /**
     * 获取登录客户端
     *
     * @return LoginClient
     */
    public function getLogin(): LoginClient
    {
        return $this->getClient('login');
    }

    /**
     * 获取税务申报客户端
     *
     * @return TaxClient
     */
    public function getTax(): TaxClient
    {
        return $this->getClient('tax');
    }

    /**
     * 获取个税客户端
     *
     * @return IitClient
     */
    public function getIit(): IitClient
    {
        return $this->getClient('iit');
    }

    /**
     * 获取办税人员管理客户端
     *
     * @return BsryglClient
     */
    public function getBsrygl(): BsryglClient
    {
        return $this->getClient('bsrygl');
    }

    /**
     * 获取产品管理客户端
     *
     * @return ProductClient
     */
    public function getProduct(): ProductClient
    {
        return $this->getClient('product');
    }

    /**
     * 获取企业信息采集客户端
     *
     * @return OrgInfoClient
     */
    public function getOrgInfo(): OrgInfoClient
    {
        return $this->getClient('orginfo');
    }

    /**
     * 获取消息客户端
     *
     * @return MessageClient
     */
    public function getMessage(): MessageClient
    {
        return $this->getClient('message');
    }

    /**
     * 获取办税小号客户端
     *
     * @return PhoneClient
     */
    public function getPhone(): PhoneClient
    {
        return $this->getClient('phone');
    }

    /**
     * 获取前台发票客户端
     *
     * @return QdfpClient
     */
    public function getQdfp(): QdfpClient
    {
        return $this->getClient('qdfp');
    }

    /**
     * 获取商品信息客户端
     *
     * @return SpxxClient
     */
    public function getSpxx(): SpxxClient
    {
        return $this->getClient('spxx');
    }

    /**
     * 获取客户信息客户端
     *
     * @return KhxxClient
     */
    public function getKhxx(): KhxxClient
    {
        return $this->getClient('khxx');
    }

    /**
     * 获取认证客户端
     *
     * @return RzClient
     */
    public function getRz(): RzClient
    {
        return $this->getClient('rz');
    }

    /**
     * 获取文件版式下载客户端
     *
     * @return SdFileClient
     */
    public function getSdFile(): SdFileClient
    {
        return $this->getClient('sdfile');
    }

    /**
     * 获取发票入账客户端
     *
     * @return FpruzClient
     */
    public function getFpruz(): FpruzClient
    {
        return $this->getClient('fpruz');
    }

    /**
     * 获取发票归集客户端
     *
     * @return GjClient
     */
    public function getGj(): GjClient
    {
        return $this->getClient('gj');
    }

    /**
     * 获取企业税务信息客户端
     *
     * @return OrgTaxInfoClient
     */
    public function getOrgTaxInfo(): OrgTaxInfoClient
    {
        return $this->getClient('orgtaxinfo');
    }

    /**
     * 获取企业税种客户端
     *
     * @return QysClient
     */
    public function getQys(): QysClient
    {
        return $this->getClient('qys');
    }

    /**
     * 获取生产经营所得客户端
     *
     * @return ScjyClient
     */
    public function getScjy(): ScjyClient
    {
        return $this->getClient('scjy');
    }

    /**
     * 获取社保客户端
     *
     * @return ShbxClient
     */
    public function getShbx(): ShbxClient
    {
        return $this->getClient('shbx');
    }

    /**
     * 获取海关客户端
     *
     * @return CustomsClient
     */
    public function getCustoms(): CustomsClient
    {
        return $this->getClient('customs');
    }

    /**
     * 获取出口退税客户端
     *
     * @return CktsClient
     */
    public function getCkts(): CktsClient
    {
        return $this->getClient('ckts');
    }

    /**
     * 获取企业采集客户端
     *
     * @return CollectClient
     */
    public function getCollect(): CollectClient
    {
        return $this->getClient('collect');
    }

    /**
     * 获取风险查询客户端
     *
     * @return RiskClient
     */
    public function getRisk(): RiskClient
    {
        return $this->getClient('risk');
    }

    /**
     * 获取企业洞察客户端
     *
     * @return InsightClient
     */
    public function getInsight(): InsightClient
    {
        return $this->getClient('insight');
    }

    /**
     * 获取政策法规客户端
     *
     * @return LegislationClient
     */
    public function getLegislation(): LegislationClient
    {
        return $this->getClient('legislation');
    }
}