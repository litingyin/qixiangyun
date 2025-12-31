<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 登录响应类型
 * 提供登录相关的链式操作方法
 */
class LoginResponse extends BaseResponse
{
    /**
     * 处理登录验证码
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processVerificationCode(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理登录缓存
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processLoginCache(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理账户验证
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processAccountValidation(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理企业列表
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processOrganizationList(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理二维码
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processQrcode(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }
    
    /**
     * 处理令牌
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processToken(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }
    
    /**
     * 提取企业列表
     * 
     * @return array
     */
    public function getOrganizationList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取二维码信息
     * 
     * @return array
     */
    public function getQrcodeInfo(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data'])) {
            return [];
        }
        return $this->data['data'];
    }
    
    /**
     * 提取令牌信息
     * 
     * @return array
     */
    public function getTokenInfo(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data'])) {
            return [];
        }
        return $this->data['data'];
    }
    
    /**
     * 提取登录状态
     * 
     * @return bool
     */
    public function getLoginStatus(): bool
    {
        if (!$this->isSuccess() || !isset($this->data['data']['status'])) {
            return false;
        }
        return (bool)$this->data['data']['status'];
    }
    
    /**
     * 提取用户ID
     * 
     * @return string
     */
    public function getUserId(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['userId'])) {
            return '';
        }
        return (string)$this->data['data']['userId'];
    }
    
    /**
     * 提取用户名
     * 
     * @return string
     */
    public function getUsername(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['username'])) {
            return '';
        }
        return (string)$this->data['data']['username'];
    }
    
    /**
     * 提取会话ID
     * 
     * @return string
     */
    public function getSessionId(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['sessionId'])) {
            return '';
        }
        return (string)$this->data['data']['sessionId'];
    }
    
    /**
     * 提取二维码URL
     * 
     * @return string
     */
    public function getQrcodeUrl(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['qrcodeUrl'])) {
            return '';
        }
        return (string)$this->data['data']['qrcodeUrl'];
    }
    
    /**
     * 提取二维码ID
     * 
     * @return string
     */
    public function getQrcodeId(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['qrcodeId'])) {
            return '';
        }
        return (string)$this->data['data']['qrcodeId'];
    }
    
    /**
     * 过滤企业列表
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterOrganizations(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 排序企业列表
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortOrganizations(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 限制返回的企业列表数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitOrganizations(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 格式化企业列表显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatOrganizations(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$org) {
                $org = $formatter($org, $this);
            }
        }
        return $this;
    }
    
    /**
     * 提取企业ID列表
     * 
     * @return array
     */
    public function getOrganizationIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $org) {
                if (isset($org['id'])) {
                    $ids[] = $org['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取企业名称列表
     * 
     * @return array
     */
    public function getOrganizationNames(): array
    {
        $names = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $org) {
                if (isset($org['name'])) {
                    $names[] = $org['name'];
                }
            }
        }
        return $names;
    }
    
    /**
     * 验证登录是否成功
     * 
     * @return bool
     */
    public function isLoginSuccessful(): bool
    {
        if (!$this->isSuccess()) {
            return false;
        }
        
        // 检查常见登录成功标识
        if (isset($this->data['data']['status']) && $this->data['data']['status'] === true) {
            return true;
        }
        
        if (isset($this->data['data']['userId']) && !empty($this->data['data']['userId'])) {
            return true;
        }
        
        if (isset($this->data['data']['sessionId']) && !empty($this->data['data']['sessionId'])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 检查是否需要验证码
     * 
     * @return bool
     */
    public function requiresVerificationCode(): bool
    {
        if (!$this->isSuccess()) {
            return false;
        }
        
        return isset($this->data['data']['needCode']) && $this->data['data']['needCode'] === true;
    }
    
    /**
     * 获取登录失败原因
     * 
     * @return string
     */
    public function getLoginFailureReason(): string
    {
        if ($this->isSuccess()) {
            return '';
        }
        
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
        
        if (isset($this->data['data']['error'])) {
            return $this->data['data']['error'];
        }
        
        return '登录失败';
    }
}