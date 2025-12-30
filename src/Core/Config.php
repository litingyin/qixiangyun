<?php

namespace QixiangyunSDK\Core;

class Config
{
    /**
     * 应用密钥
     *
     * @var string
     */
    protected $appKey;
    
    /**
     * API主机地址
     *
     * @var string
     */
    protected $apiHost;
    
    /**
     * 应用密钥
     *
     * @var string
     */
    protected $appSecret;
    
    /**
     * 请求超时时间（秒）
     *
     * @var int
     */
    protected $timeout = 10;
    
    /**
     * 是否启用token缓存
     *
     * @var bool
     */
    protected $enableCache = true;
    
    /**
     * token缓存目录
     *
     * @var string
     */
    protected $cacheDir;
    
    /**
     * 默认配置
     *
     * @var array
     */
    protected $defaultConfig = [
        'timeout' => 10,
        'enableCache' => true,
        'cacheDir' => null, // 默认使用系统临时目录
    ];
    
    /**
     * 构造函数
     *
     * @param array $config 配置数组
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        // 合并默认配置
        $config = array_merge($this->defaultConfig, $config);
        
        // 验证必需配置
        if (empty($config['appKey'])) {
            throw new \Exception('appKey is required');
        }
        
        if (empty($config['apiHost'])) {
            throw new \Exception('apiHost is required');
        }
        
        if (empty($config['appSecret'])) {
            throw new \Exception('appSecret is required');
        }
        
        // 设置配置
        $this->appKey = $config['appKey'];
        $this->apiHost = $config['apiHost'];
        $this->appSecret = $config['appSecret'];
        $this->timeout = (int)$config['timeout'];
        $this->enableCache = (bool)$config['enableCache'];
        
        // 设置缓存目录
        if (!empty($config['cacheDir'])) {
            $this->cacheDir = $config['cacheDir'];
        } else {
            $this->cacheDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'qixiangyun_sdk_cache';
        }
        
        // 确保缓存目录存在
        if ($this->enableCache && !is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }
    
    /**
     * 获取应用密钥
     *
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }
    
    /**
     * 获取API主机地址
     *
     * @return string
     */
    public function getApiHost(): string
    {
        return $this->apiHost;
    }
    
    /**
     * 获取应用密钥
     *
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }
    
    /**
     * 获取请求超时时间
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
    
    /**
     * 是否启用token缓存
     *
     * @return bool
     */
    public function isEnableCache(): bool
    {
        return $this->enableCache;
    }
    
    /**
     * 获取缓存目录
     *
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }
    
    /**
     * 获取完整的API URL
     *
     * @param string $endpoint API端点
     * @return string
     */
    public function getApiUrl(string $endpoint): string
    {
        return rtrim($this->apiHost, '/') . '/' . ltrim($endpoint, '/');
    }
    
    /**
     * 更新配置
     *
     * @param array $config 新配置
     * @return void
     */
    public function update(array $config): void
    {
        $this->__construct(array_merge([
            'appKey' => $this->appKey,
            'apiHost' => $this->apiHost,
            'appSecret' => $this->appSecret,
            'timeout' => $this->timeout,
            'enableCache' => $this->enableCache,
            'cacheDir' => $this->cacheDir,
        ], $config));
    }
}