<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 税务申报响应类
 * 提供税务申报相关API的返回值类型定义
 */
class TaxResponse extends Response
{
    /**
     * 获取申报任务ID
     *
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->get('taskId', '');
    }
    
    /**
     * 获取申报状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取申报期间
     *
     * @return string
     */
    public function getTaxPeriod(): string
    {
        return $this->get('taxPeriod', '');
    }
    
    /**
     * 获取税种
     *
     * @return string
     */
    public function getTaxType(): string
    {
        return $this->get('taxType', '');
    }
    
    /**
     * 获取应缴税额
     *
     * @return float
     */
    public function getTaxAmount(): float
    {
        return (float) $this->get('taxAmount', 0);
    }
    
    /**
     * 获取已缴税额
     *
     * @return float
     */
    public function getPaidAmount(): float
    {
        return (float) $this->get('paidAmount', 0);
    }
    
    /**
     * 获取申报结果
     *
     * @return array
     */
    public function getResult(): array
    {
        return $this->get('result', []);
    }
    
    /**
     * 获取申报表数据
     *
     * @return array
     */
    public function getTaxFormData(): array
    {
        return $this->get('taxFormData', []);
    }
    
    /**
     * 检查申报是否成功
     *
     * @return bool
     */
    public function isDeclarationSuccess(): bool
    {
        return $this->isSuccess() && in_array($this->getStatus(), ['success', 'completed']);
    }
    
    /**
     * 检查是否需要补缴税款
     *
     * @return bool
     */
    public function hasTaxToPay(): bool
    {
        return $this->getTaxAmount() > $this->getPaidAmount();
    }
    
    /**
     * 链式操作：获取申报信息并继续处理
     *
     * @param callable $callback 处理申报信息的回调
     * @return self
     */
    public function processDeclaration(callable $callback): self
    {
        if ($this->isDeclarationSuccess()) {
            $declarationData = [
                'taskId' => $this->getTaskId(),
                'status' => $this->getStatus(),
                'taxPeriod' => $this->getTaxPeriod(),
                'taxType' => $this->getTaxType(),
                'taxAmount' => $this->getTaxAmount(),
                'paidAmount' => $this->getPaidAmount(),
                'hasTaxToPay' => $this->hasTaxToPay(),
                'result' => $this->getResult()
            ];
            
            return $callback($declarationData, $this);
        }
        
        return $this;
    }
}