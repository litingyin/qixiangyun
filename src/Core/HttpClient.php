<?php

namespace QixiangyunSDK\Core;

use QixiangyunSDK\Exceptions\QixiangyunException;
use QixiangyunSDK\Exceptions\AuthTokenException;

class HttpClient
{
    /**
     * SDK配置
     *
     * @var Config
     */
    protected $config;
    
    /**
     * 缓存的访问令牌
     *
     * @var string|null
     */
    protected $accessToken = null;
    
    /**
     * 缓存文件名
     *
     * @var string
     */
    protected $cacheFile;
    
    /**
     * 最大重试次数
     *
     * @var int
     */
    protected $maxRetries = 3;
    
    /**
     * 重试延迟（毫秒）
     *
     * @var int
     */
    protected $retryDelay = 1000;
    
    /**
     * 构造函数
     *
     * @param Config $config SDK配置
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->cacheFile = $this->config->getCacheDir() . DIRECTORY_SEPARATOR . 'token_cache.json';
    }
    
    /**
     * 发送GET请求
     *
     * @param string $endpoint API端点
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function get(string $endpoint, array $params = []): array
    {
        $url = $this->config->getApiUrl($endpoint);
        
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        
        $headers = $this->buildHeaders('', $url);
        
        return $this->executeRequest('GET', $url, '', $headers);
    }
    
    /**
     * 发送POST请求
     *
     * @param string $endpoint API端点
     * @param array $data 请求数据
     * @return array
     * @throws QixiangyunException
     */
    public function post(string $endpoint, array $data = []): array
    {
        $url = $this->config->getApiUrl($endpoint);
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $headers = $this->buildHeaders($jsonData, $url);
        
        return $this->executeRequest('POST', $url, $jsonData, $headers);
    }
    
    /**
     * 获取访问令牌
     *
     * @return string
     * @throws AuthTokenException
     */
    protected function getAccessToken(): string
    {
        // 如果已缓存token，直接返回
        if ($this->accessToken !== null) {
            return $this->accessToken;
        }
        
        // 如果启用缓存，尝试从缓存文件读取token
        if ($this->config->isEnableCache() && file_exists($this->cacheFile)) {
            $cacheData = json_decode(file_get_contents($this->cacheFile), true);
            
            // 检查token是否仍然有效（假设有效期15天）
            if ($cacheData && isset($cacheData['access_token']) && isset($cacheData['cached_at'])) {
                $cacheTime = $cacheData['cached_at'];
                $currentTime = time();
                
                // 15天 = 15 * 24 * 60 * 60 = 1296000秒
                if ($currentTime - $cacheTime < 1296000) {
                    $this->accessToken = $cacheData['access_token'];
                    return $this->accessToken;
                }
            }
        }
        
        // 获取新token
        $tokenUrl = $this->config->getApiUrl('v2/public/oauth2/login');
        
        $params = [
            'grant_type' => 'client_credentials',
            'client_appkey' => $this->config->getAppKey(),
            'client_secret' => md5($this->config->getAppSecret()),
        ];
        
        $jsonData = json_encode($params);
        $headers = [
            'Content-Type: application/json; charset=utf-8',
        ];
        
        $response = $this->executeRequestWithoutToken('POST', $tokenUrl, $jsonData, $headers);
        
        if (!isset($response['value']['access_token'])) {
            throw AuthTokenException::failedToRetrieveToken(
                'Failed to get access token: ' . json_encode($response, JSON_UNESCAPED_UNICODE)
            );
        }
        
        $this->accessToken = $response['value']['access_token'];
        
        // 缓存token
        if ($this->config->isEnableCache()) {
            $cacheData = [
                'access_token' => $this->accessToken,
                'cached_at' => time(),
            ];
            file_put_contents($this->cacheFile, json_encode($cacheData));
        }
        
        return $this->accessToken;
    }
    
    /**
     * 构建请求头
     *
     * @param string $jsonData 请求数据JSON字符串
     * @param string $url 请求URL
     * @return array
     * @throws AuthTokenException
     */
    protected function buildHeaders(string $jsonData, string $url): array
    {
        $accessToken = $this->getAccessToken();
        $reqDate = time() * 1000; // 毫秒时间戳
        
        // 构建签名字符串
        $signStr = 'POST' . '_' . md5($jsonData) . '_' . $reqDate . '_' . $accessToken . '_' . $this->config->getAppSecret();
        $reqSign = 'API-SV1' . ':' . $this->config->getAppKey() . ':' . base64_encode(md5($signStr));
        
        return [
            'Content-Type: application/json; charset=utf-8',
            'req_date: ' . $reqDate,
            'access_token: ' . $accessToken,
            'req_sign: ' . $reqSign,
        ];
    }
    
    /**
     * 执行HTTP请求（带重试）
     *
     * @param string $method 请求方法
     * @param string $url 请求URL
     * @param string $data 请求数据
     * @param array $headers 请求头
     * @return array
     * @throws QixiangyunException
     */
    protected function executeRequest(string $method, string $url, string $data, array $headers): array
    {
        $lastException = null;
        
        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                return $this->doRequest($method, $url, $data, $headers);
            } catch (QixiangyunException $e) {
                $lastException = $e;
                
                // 对于某些错误类型，不重试
                if ($e instanceof AuthTokenException || $e->getErrorCode() === 'VALIDATION_ERROR') {
                    throw $e;
                }
                
                // 如果是最后一次尝试，抛出异常
                if ($attempt >= $this->maxRetries) {
                    throw $e;
                }
                
                // 等待后重试
                usleep($this->retryDelay * 1000 * $attempt);
            }
        }
        
        throw $lastException;
    }
    
    /**
     * 执行HTTP请求（不获取token）
     *
     * @param string $method 请求方法
     * @param string $url 请求URL
     * @param string $data 请求数据
     * @param array $headers 请求头
     * @return array
     * @throws QixiangyunException
     */
    protected function executeRequestWithoutToken(string $method, string $url, string $data, array $headers): array
    {
        return $this->doRequest($method, $url, $data, $headers);
    }
    
    /**
     * 执行HTTP请求
     *
     * @param string $method 请求方法
     * @param string $url 请求URL
     * @param string $data 请求数据
     * @param array $headers 请求头
     * @return array
     * @throws QixiangyunException
     */
    protected function doRequest(string $method, string $url, string $data, array $headers): array
    {
        // 初始化cURL
        $curl = curl_init();
        
        if ($curl === false) {
            throw QixiangyunException::networkError('Failed to initialize cURL');
        }
        
        try {
            // 设置cURL选项
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->config->getTimeout());
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            // 根据请求方法设置
            if ($method === 'POST') {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            
            // 执行请求
            $response = curl_exec($curl);
            
            // 检查是否有错误
            if (curl_errno($curl)) {
                $error = curl_error($curl);
                throw QixiangyunException::networkError('HTTP Request Error: ' . $error);
            }
            
            // 获取HTTP状态码
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            // 解析响应
            $responseData = json_decode($response, true);
            
            if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
                throw QixiangyunException::apiError('Invalid JSON response: ' . $response, 'JSON_PARSE_ERROR');
            }
            
            // 检查HTTP状态码
            if ($httpCode !== 200) {
                $message = $responseData['message'] ?? 'Unknown error';
                $errorCode = $responseData['code'] ?? null;
                
                throw QixiangyunException::apiError(
                    'HTTP Error: ' . $httpCode . ' - ' . $message,
                    $errorCode,
                    $responseData
                );
            }
            
            return $responseData;
        } finally {
            curl_close($curl);
        }
    }
    
    /**
     * 设置最大重试次数
     *
     * @param int $maxRetries
     * @return self
     */
    public function setMaxRetries(int $maxRetries): self
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }
    
    /**
     * 设置重试延迟
     *
     * @param int $retryDelay
     * @return self
     */
    public function setRetryDelay(int $retryDelay): self
    {
        $this->retryDelay = $retryDelay;
        return $this;
    }
    
    /**
     * 清除缓存的访问令牌
     *
     * @return void
     */
    public function clearTokenCache(): void
    {
        $this->accessToken = null;
        
        if (file_exists($this->cacheFile)) {
            @unlink($this->cacheFile);
        }
    }
    
    /**
     * 刷新访问令牌
     *
     * @return void
     * @throws AuthTokenException
     */
    public function refreshToken(): void
    {
        $this->clearTokenCache();
        $this->getAccessToken();
    }
}