<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 办税人员管理响应类
 * 提供办税人员相关API的返回值类型定义
 */
class BsryglResponse extends Response
{
    /**
     * 获取任务ID
     *
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->get('taskId', '');
    }
    
    /**
     * 获取办税人员ID
     *
     * @return string
     */
    public function getBsyId(): string
    {
        return $this->get('bsyId', '');
    }
    
    /**
     * 获取办税人员姓名
     *
     * @return string
     */
    public function getBsyName(): string
    {
        return $this->get('bsyName', '');
    }
    
    /**
     * 获取身份证号码
     *
     * @return string
     */
    public function getIdCardNo(): string
    {
        return $this->get('idCardNo', '');
    }
    
    /**
     * 获取手机号码
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->get('phoneNumber', '');
    }
    
    /**
     * 获取办税人员类型
     *
     * @return string
     */
    public function getBsyType(): string
    {
        return $this->get('bsyType', '');
    }
    
    /**
     * 获取状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取二维码URL
     *
     * @return string
     */
    public function getQrcodeUrl(): string
    {
        return $this->get('qrcodeUrl', '');
    }
    
    /**
     * 检查办税人员信息是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getBsyId());
    }
    
    /**
     * 链式操作：获取办税人员信息并继续处理
     *
     * @param callable $callback 处理办税人员信息的回调
     * @return self
     */
    public function processBsy(callable $callback): self
    {
        if ($this->isValid()) {
            $bsyData = [
                'taskId' => $this->getTaskId(),
                'id' => $this->getBsyId(),
                'name' => $this->getBsyName(),
                'idCardNo' => $this->getIdCardNo(),
                'phoneNumber' => $this->getPhoneNumber(),
                'type' => $this->getBsyType(),
                'status' => $this->getStatus(),
                'qrcodeUrl' => $this->getQrcodeUrl()
            ];
            
            return $callback($bsyData, $this);
        }
        
        return $this;
    }
}