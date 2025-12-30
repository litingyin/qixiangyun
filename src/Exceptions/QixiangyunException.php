<?php

namespace QixiangyunSDK\Exceptions;

use Exception;

class QixiangyunException extends Exception
{
    /**
     * 错误代码
     *
     * @var string|null
     */
    protected $errorCode;
    
    /**
     * 原始响应数据
     *
     * @var array|null
     */
    protected $responseData;
    
    /**
     * 构造函数
     *
     * @param string $message 错误消息
     * @param string|null $errorCode 错误代码
     * @param array|null $responseData 响应数据
     * @param int $code HTTP状态码
     * @param Exception|null $previous 前一个异常
     */
    public function __construct(
        string $message,
        ?string $errorCode = null,
        ?array $responseData = null,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        
        $this->errorCode = $errorCode;
        $this->responseData = $responseData;
    }
    
    /**
     * 获取错误代码
     *
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }
    
    /**
     * 获取原始响应数据
     *
     * @return array|null
     */
    public function getResponseData(): ?array
    {
        return $this->responseData;
    }
    
    /**
     * 创建认证错误异常
     *
     * @param string $message
     * @return static
     */
    public static function authenticationError(string $message = 'Authentication failed'): self
    {
        return new static($message, 'AUTH_ERROR');
    }
    
    /**
     * 创建网络错误异常
     *
     * @param string $message
     * @return static
     */
    public static function networkError(string $message = 'Network error'): self
    {
        return new static($message, 'NETWORK_ERROR');
    }
    
    /**
     * 创建API错误异常
     *
     * @param string $message
     * @param string|null $errorCode
     * @param array|null $responseData
     * @return static
     */
    public static function apiError(string $message, ?string $errorCode = null, ?array $responseData = null): self
    {
        return new static($message, $errorCode ?? 'API_ERROR', $responseData);
    }
    
    /**
     * 创建请求验证错误异常
     *
     * @param string $message
     * @return static
     */
    public static function validationError(string $message = 'Validation failed'): self
    {
        return new static($message, 'VALIDATION_ERROR');
    }
    
    /**
     * 创建限流错误异常
     *
     * @param string $message
     * @return static
     */
    public static function rateLimitError(string $message = 'Rate limit exceeded'): self
    {
        return new static($message, 'RATE_LIMIT_ERROR');
    }
}