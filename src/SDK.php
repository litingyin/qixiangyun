<?php

namespace QixiangyunSDK;

use QixiangyunSDK\Core\Config;
use QixiangyunSDK\Core\ClientFactory;

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
}