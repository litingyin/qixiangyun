<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 发票归集响应类
 * 提供发票归集相关API的返回值类型定义
 */
class GjResponse extends Response
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
     * 获取类型
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->get('type', '');
    }
    
    /**
     * 获取汇总金额
     *
     * @return float
     */
    public function getSummaryAmount(): float
    {
        return (float) $this->get('summaryAmount', 0);
    }
    
    /**
     * 获取发票数据
     *
     * @return array
     */
    public function getInvoiceData(): array
    {
        return $this->get('invoiceData', []);
    }
    
    /**
     * 获取汇总信息
     *
     * @return array
     */
    public function getSummaryInfo(): array
    {
        return $this->get('summaryInfo', []);
    }
    
    /**
     * 检查归集是否成功
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getTaskId());
    }
    
    /**
     * 链式操作：获取归集信息并继续处理
     *
     * @param callable $callback 处理归集信息的回调
     * @return self
     */
    public function processGj(callable $callback): self
    {
        if ($this->isValid()) {
            $gjData = [
                'taskId' => $this->getTaskId(),
                'aggOrgId' => $this->getaggOrgId(),
                'type' => $this->getType(),
                'summaryAmount' => $this->getSummaryAmount(),
                'invoiceData' => $this->getInvoiceData(),
                'summaryInfo' => $this->getSummaryInfo()
            ];
            
            return $callback($gjData, $this);
        }
        
        return $this;
    }
}