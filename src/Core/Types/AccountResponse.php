<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 账户管理响应类
 * 提供账户管理相关API的返回值类型定义
 */
class AccountResponse extends Response
{
    /**
     * 获取账户ID
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->get('accountId', '');
    }
    
    /**
     * 获取用户名
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->get('username', '');
    }
    
    /**
     * 获取账户类型
     *
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->get('accountType', '');
    }
    
    /**
     * 获取账户状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取企业ID列表
     *
     * @return array
     */
    public function getOrgIds(): array
    {
        return $this->get('orgIds', []);
    }
    
    /**
     * 获取角色
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->get('role', '');
    }
    
    /**
     * 获取权限列表
     *
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->get('permissions', []);
    }
    
    /**
     * 获取创建时间
     *
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->get('createTime', '');
    }
    
    /**
     * 获取最后登录时间
     *
     * @return string
     */
    public function getLastLoginTime(): string
    {
        return $this->get('lastLoginTime', '');
    }
    
    /**
     * 检查账户是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getAccountId());
    }
    
    /**
     * 检查账户是否激活
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getStatus() === 'active';
    }
    
    /**
     * 检查是否有指定权限
     *
     * @param string $permission 权限名称
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->getPermissions());
    }
    
    /**
     * 链式操作：获取账户信息并继续处理
     *
     * @param callable $callback 处理账户信息的回调
     * @return self
     */
    public function processAccount(callable $callback): self
    {
        if ($this->isValid()) {
            $accountData = [
                'id' => $this->getAccountId(),
                'username' => $this->getUsername(),
                'accountType' => $this->getAccountType(),
                'status' => $this->getStatus(),
                'orgIds' => $this->getOrgIds(),
                'role' => $this->getRole(),
                'permissions' => $this->getPermissions(),
                'isActive' => $this->isActive(),
                'createTime' => $this->getCreateTime(),
                'lastLoginTime' => $this->getLastLoginTime()
            ];
            
            return $callback($accountData, $this);
        }
        
        return $this;
    }
}