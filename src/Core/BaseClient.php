<?php

namespace QixiangyunSDK\Core;

use QixiangyunSDK\Core\Config;
use QixiangyunSDK\Core\HttpClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

abstract class BaseClient
{
    /**
     * HTTP客户端
     *
     * @var HttpClient
     */
    protected $httpClient;
    
    /**
     * SDK配置
     *
     * @var Config
     */
    protected $config;
    
    /**
     * 构造函数
     *
     * @param Config $config SDK配置
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new HttpClient($config);
    }
    
    /**
     * 获取客户端名称
     *
     * @return string
     */
    abstract public function getClientName(): string;
    
    /**
     * 验证参数
     *
     * @param array $params 待验证的参数
     * @param array $required 必需的参数字段
     * @throws QixiangyunException
     */
    protected function validateParams(array $params, array $required): void
    {
        foreach ($required as $field) {
            if (!isset($params[$field]) || $params[$field] === '') {
                throw new QixiangyunException("Missing required parameter: {$field}");
            }
        }
    }
    
    /**
     * 发送HTTP请求
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return array
     * @throws QixiangyunException
     */
    protected function request(string $endpoint, array $params = [], string $method = 'POST'): array
    {
        try {
            $this->logDebug("Sending request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $response = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Request successful: {$endpoint}");
            
            return $response;
        } catch (\Exception $e) {
            $this->logError("Request failed: {$endpoint}", $e);
            throw new QixiangyunException("Request failed: " . $e->getMessage(), null, null, 0, $e);
        }
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
            '[%s] [%s] %s',
            date('Y-m-d H:i:s'),
            $level,
            $message
        );
        
        // 这里可以扩展为写入文件或使用Monolog等日志库
        error_log($logMessage);
    }
    
    /**
     * 记录错误日志
     *
     * @param string $message 错误消息
     * @param \Exception $exception 异常对象
     * @return void
     */
    protected function logError(string $message, \Exception $exception = null): void
    {
        $errorMessage = $message;
        
        if ($exception) {
            $errorMessage .= ': ' . $exception->getMessage();
        }
        
        $this->log($errorMessage, 'error');
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
}