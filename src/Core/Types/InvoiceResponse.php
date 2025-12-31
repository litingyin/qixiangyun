<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 发票响应类
 * 提供发票相关API的返回值类型定义
 */
class InvoiceResponse extends Response
{
    /**
     * 获取发票代码
     *
     * @return string
     */
    public function getInvoiceCode(): string
    {
        return $this->get('fpdm', '');
    }
    
    /**
     * 获取发票号码
     *
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->get('fphm', '');
    }
    
    /**
     * 获取开票日期
     *
     * @return string
     */
    public function getInvoiceDate(): string
    {
        return $this->get('kprq', '');
    }
    
    /**
     * 获取发票金额
     *
     * @return float
     */
    public function getAmount(): float
    {
        return (float) $this->get('je', 0);
    }
    
    /**
     * 获取发票类型
     *
     * @return string
     */
    public function getInvoiceType(): string
     {
        return $this->get('fplx', '');
    }
    
    /**
     * 获取购买方名称
     *
     * @return string
     */
    public function getPurchaserName(): string
     {
        return $this->get('gmfmc', '');
    }
    
    /**
     * 获取销售方名称
     *
     * @return string
     */
    public function getSellerName(): string
     {
        return $this->get('xsfmc', '');
    }
    
    /**
     * 检查发票是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getInvoiceCode());
    }
    
    /**
     * 链式操作：获取发票信息并继续处理
     *
     * @param callable $callback 处理发票信息的回调
     * @return self
     */
    public function processInvoice(callable $callback): self
    {
        if ($this->isValid()) {
            $invoiceData = [
                'code' => $this->getInvoiceCode(),
                'number' => $this->getInvoiceNumber(),
                'date' => $this->getInvoiceDate(),
                'amount' => $this->getAmount(),
                'type' => $this->getInvoiceType(),
                'purchaser' => $this->getPurchaserName(),
                'seller' => $this->getSellerName()
            ];
            
            return $callback($invoiceData, $this);
        }
        
        return $this;
    }
}