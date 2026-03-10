<?php

/**
 * 改进的 HttpClient - 支持自动Token刷新
 * 
 * 这是 vendor/qixiangyun/sdk/src/Core/HttpClient.php 的改进版本
 * 主要改进：
 * 1. 自动检测401/token失效错误
 * 2. 自动清除过期token并重新获取
 * 3. 失效后自动重试原始请求（最多1次）
 * 4. 添加详细的日志记录
 */

namespace QixiangyunSDK\Core;

use Illuminate\Support\Facades\Log;
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
     * 最大重试次数（针对非token错误）
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
     * Token失效时的最大重试次数
     *
     * @var int
     */
    protected $maxTokenRefreshRetries = 2;

    /**
     * Token刷新后的自动重试次数
     *
     * @var int
     */
    protected $autoRetryAfterTokenRefresh = 1;

    /**
     * 是否正在进行token刷新
     *
     * @var bool
     */
    protected $isRefreshing = false;

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
                    $this->logDebug("使用缓存的token");
                    return $this->accessToken;
                } else {
                    $this->logInfo("缓存的token已过期");
                }
            }
        }

        // 获取新token
        $this->logInfo("正在获取新的access token...");
        return $this->fetchNewToken();
    }

    /**
     * 获取新的访问令牌
     *
     * @return string
     * @throws AuthTokenException
     */
    protected function fetchNewToken(): string
    {
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
        
        if (!$response || $response['code'] != 2000) {
            throw AuthTokenException::failedToRetrieveToken(
                'Failed to get access token: ' . ($response['message'] ?? '未知错误')
            );
        }

        if (!isset($response['data']['access_token'])) {
            throw AuthTokenException::failedToRetrieveToken(
                'Failed to get access token: ' . json_encode($response, JSON_UNESCAPED_UNICODE)
            );
        }

        $this->accessToken = $response['data']['access_token'];

        // 缓存token
        if ($this->config->isEnableCache()) {
            $cacheData = [
                'access_token' => $this->accessToken,
                'cached_at' => time(),
            ];
            file_put_contents($this->cacheFile, json_encode($cacheData));
            $this->logInfo("新token已缓存");
        }

        $this->logInfo("成功获取新的access token");
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
     * 执行HTTP请求（带自动token刷新重试）
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
        $tokenRefreshAttempts = 0;

        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                $response = $this->doRequest($method, $url, $data, $headers);

                // 检查响应是否包含token失效错误
                if ($this->isTokenExpiredError($response)) {
                    $this->logWarning("检测到token失效错误，尝试刷新token...");

                    if ($tokenRefreshAttempts >= $this->maxTokenRefreshRetries) {
                        throw AuthTokenException::tokenExpired(
                            'Token refresh failed after ' . $this->maxTokenRefreshRetries . ' attempts'
                        );
                    }

                    $tokenRefreshAttempts++;

                    // 清除并刷新token
                    $this->clearTokenCache();
                    $this->accessToken = null; // 强制重新获取
                    $newToken = $this->getAccessToken();

                    // 重新构建请求头（使用新token）
                    if ($method === 'POST') {
                        $headers = $this->buildHeaders($data, $url);
                    } else {
                        $headers = $this->buildHeaders('', $url);
                    }

                    $this->logInfo("Token已刷新，重试请求 (尝试 {$tokenRefreshAttempts}/{$this->maxTokenRefreshRetries})");
                    
                    // 继续下一次循环尝试
                    continue;
                }

                // 成功返回
                return $response;

            } catch (QixiangyunException $e) {
                $lastException = $e;

                // 对于某些错误类型，不重试
                if ($e instanceof AuthTokenException) {
                    $this->logError("Token认证错误: " . $e->getMessage());
                    throw $e;
                }

                // 如果是最后一次尝试，抛出异常
                if ($attempt >= $this->maxRetries) {
                    throw $e;
                }

                // 等待后重试
                $waitTime = $this->retryDelay * $attempt;
                $this->logInfo("请求失败，{$waitTime}ms后重试 (尝试 {$attempt}/{$this->maxRetries})");
                usleep($waitTime * 1000);
            }
        }

        throw $lastException;
    }

    /**
     * 检查响应是否为token失效错误
     *
     * @param array $response 响应数据
     * @return bool
     */
    protected function isTokenExpiredError(array $response): bool
    {
        // 检查HTTP状态码
        if (isset($response['http_code']) && $response['http_code'] === 401) {
            return true;
        }

        // 检查业务错误码
        if (isset($response['code'])) {
            $tokenErrorCodes = [
                '401',           // 未授权
                'TOKEN_EXPIRED', // Token过期
                'INVALID_TOKEN', // 无效token
                'AUTH_ERROR',    // 认证错误
                'AUTH_FAILED',   // 认证失败
            ];

            if (in_array($response['code'], $tokenErrorCodes)) {
                return true;
            }
        }

        // 检查消息内容
        if (isset($response['message'])) {
            $tokenErrorMessages = [
                'token已过期',
                'token失效',
                'token无效',
                'access token已过期',
                'access token失效',
                'access token无效',
                '未授权',
                'unauthorized',
                'token expired',
                'invalid token',
            ];

            $message = strtolower($response['message']);
            foreach ($tokenErrorMessages as $errorMsg) {
                if (strpos($message, strtolower($errorMsg)) !== false) {
                    return true;
                }
            }
        }

        return false;
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
                throw QixiangyunException::apiError(
                    'Invalid JSON response: ' . $response,
                    'JSON_PARSE_ERROR'
                );
            }

            // 添加HTTP状态码到响应中（用于token失效检测）
            $responseData['http_code'] = $httpCode;

            // 检查HTTP状态码
            if ($httpCode !== 200) {
                $message = $responseData['message'] ?? 'Unknown error';
                $errorCode = $responseData['code'] ?? null;

                $this->logError("HTTP {$httpCode} 错误: {$message}");
                
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
        $this->logDebug("清除内存中的token缓存");

        if (file_exists($this->cacheFile)) {
            @unlink($this->cacheFile);
            $this->logDebug("清除磁盘上的token缓存文件");
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
        $this->logInfo("手动触发token刷新");
        $this->clearTokenCache();
        $this->getAccessToken();
    }

    /**
     * 记录日志
     *
     * @param string $message 日志消息
     * @param string $level 日志级别
     * @return void
     */
    protected function log(string $message, string $level = 'info'): void
    {
        $logMessage = sprintf(
            '[%s] [%s] [HttpClient] %s',
            date('Y-m-d H:i:s'),
            $level,
            $message
        );

        // 如果Laravel Log可用，使用Laravel日志
        if (class_exists('\Illuminate\Support\Facades\Log')) {
            switch ($level) {
                case 'error':
                    Log::error($message);
                    break;
                case 'warning':
                    Log::warning($message);
                    break;
                case 'debug':
                    Log::debug($message);
                    break;
                default:
                    Log::info($message);
                    break;
            }
        } else {
            error_log($logMessage);
        }
    }

    /**
     * 记录调试日志
     *
     * @param string $message 调试消息
     * @return void
     */
    protected function logDebug(string $message): void
    {
        $this->log($message, 'debug');
    }

    /**
     * 记录信息日志
     *
     * @param string $message 信息消息
     * @return void
     */
    protected function logInfo(string $message): void
    {
        $this->log($message, 'info');
    }

    /**
     * 记录警告日志
     *
     * @param string $message 警告消息
     * @return void
     */
    protected function logWarning(string $message): void
    {
        $this->log($message, 'warning');
    }

    /**
     * 记录错误日志
     *
     * @param string $message 错误消息
     * @return void
     */
    protected function logError(string $message): void
    {
        $this->log($message, 'error');
    }
}
