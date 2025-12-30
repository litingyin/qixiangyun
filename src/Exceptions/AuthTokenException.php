<?php

namespace QixiangyunSDK\Exceptions;

class AuthTokenException extends QixiangyunException
{
    /**
     * 创建Token获取失败异常
     *
     * @param string $message
     * @return static
     */
    public static function failedToRetrieveToken(string $message = 'Failed to retrieve access token'): self
    {
        return new static($message, 'TOKEN_RETRIEVE_FAILED');
    }
    
    /**
     * 创建Token过期异常
     *
     * @param string $message
     * @return static
     */
    public static function tokenExpired(string $message = 'Access token has expired'): self
    {
        return new static($message, 'TOKEN_EXPIRED');
    }
    
    /**
     * 创建Token无效异常
     *
     * @param string $message
     * @return static
     */
    public static function invalidToken(string $message = 'Invalid access token'): self
    {
        return new static($message, 'INVALID_TOKEN');
    }
}