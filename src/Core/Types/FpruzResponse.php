<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 发票入账响应类
 * 提供发票入账相关API的返回值类型定义
 */
class FpruzResponse extends Response
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
     * 获取企业ID
     *
     * @return string
     */
    public function getaggOrgId(): string
    {
        return $this->get('aggOrgId', '');
    }
    
    /**
     * 获取发票ID
     *
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->get('invoiceId', '');
    }
    
    /**
     * 获取入账状态
     *
     * @return string
     */
    public function getAccountingStatus(): string
    {
        return $this->get('accountingStatus', '');
    }
    
    /**
     * 获取海关缴款书ID
     *
     * @return string
     */
    public function getCustomsId(): string
    {
        return $this->get('customsId', '');
    }
    
    /**
     * 获取代扣代缴ID
     *
     * @return string
     */
    public function getWithholdingId(): string
    {
        return $this->get('withholdingId', '');
    }
    
    /**
     * 获取入账信息
     *
     * @return array
     */
    public function getAccountingInfo(): array
    {
        return $this->get('accountingInfo', []);
    }
    
    /**
     * 检查入账是否成功
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getData());
    }
    
    /**
     * 链式操作：获取入账信息并继续处理
     *
     * @param callable $callback 处理入账信息的回调
     * @return self
     */
    public function processFpruz(callable $callback): self
    {
        if ($this->isValid()) {
            $fpruzData = [
                'taskId' => $this->getTaskId(),
                'aggOrgId' => $this->getaggOrgId(),
                'invoiceId' => $this->getInvoiceId(),
                'accountingStatus' => $this->getAccountingStatus(),
                'customsId' => $this->getCustomsId(),
                'withholdingId' => $this->getWithholdingId(),
                'accountingInfo' => $this->getAccountingInfo()
            ];
            
            return $callback($fpruzData, $this);
        }
        
        return $this;
    }
}