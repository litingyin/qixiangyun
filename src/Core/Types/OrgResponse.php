<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 企业信息响应类
 * 提供企业相关API的返回值类型定义
 */
class OrgResponse extends Response
{
    /**
     * 获取企业ID
     *
     * @return string
     */
    public function getOrgId(): string
    {
        return $this->get('orgId', '');
    }
    
    /**
     * 获取企业名称
     *
     * @return string
     */
    public function getOrgName(): string
    {
        return $this->get('orgName', '');
    }
    
    /**
     * 获取统一社会信用代码
     *
     * @return string
     */
    public function getCreditCode(): string
    {
        return $this->get('tyshxydm', '');
    }
    
    /**
     * 获取法定代表人
     *
     * @return string
     */
    public function getLegalRepresentative(): string
    {
        return $this->get('fddbr', '');
    }
    
    /**
     * 获取注册地址
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->get('zcdz', '');
    }
    
    /**
     * 获取联系电话
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->get('lxdh', '');
    }
    
    /**
     * 获取经营范围
     *
     * @return string
     */
    public function getBusinessScope(): string
    {
        return $this->get('jyfw', '');
    }
    
    /**
     * 获取成立日期
     *
     * @return string
     */
    public function getEstablishDate(): string
    {
        return $this->get('clrq', '');
    }
    
    /**
     * 获取企业状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('qyzt', '');
    }
    
    /**
     * 检查企业信息是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getOrgId());
    }
    
    /**
     * 链式操作：获取企业信息并继续处理
     *
     * @param callable $callback 处理企业信息的回调
     * @return self
     */
    public function processOrg(callable $callback): self
    {
        if ($this->isValid()) {
            $orgData = [
                'id' => $this->getOrgId(),
                'name' => $this->getOrgName(),
                'creditCode' => $this->getCreditCode(),
                'legalRepresentative' => $this->getLegalRepresentative(),
                'address' => $this->getAddress(),
                'phone' => $this->getPhone(),
                'businessScope' => $this->getBusinessScope(),
                'establishDate' => $this->getEstablishDate(),
                'status' => $this->getStatus()
            ];
            
            return $callback($orgData, $this);
        }
        
        return $this;
    }
}