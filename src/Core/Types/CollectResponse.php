<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 企业采集响应类
 * 提供企业采集相关API的返回值类型定义
 */
class CollectResponse extends Response
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
    public function getOrgId(): string
    {
        return $this->get('orgId', '');
    }
    
    /**
     * 获取采集状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取采集进度
     *
     * @return int
     */
    public function getProgress(): int
    {
        return (int) $this->get('progress', 0);
    }
    
    /**
     * 获取数据类型
     *
     * @return string
     */
    public function getDataType(): string
    {
        return $this->get('dataType', '');
    }
    
    /**
     * 获取采集详情
     *
     * @return array
     */
    public function getDetails(): array
    {
        return $this->get('details', []);
    }
    
    /**
     * 获取采集数据
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->get('data', []);
    }
    
    /**
     * 获取税务数据
     *
     * @return array
     */
    public function getTaxData(): array
    {
        return $this->get('taxData', []);
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
     * 检查采集是否成功
     *
     * @return bool
     */
    public function isCollectSuccess(): bool
    {
        return $this->isSuccess() && in_array($this->getStatus(), ['success', 'completed']);
    }
    
    /**
     * 检查是否还在采集进行中
     *
     * @return bool
     */
    public function isInProgress(): bool
    {
        return in_array($this->getStatus(), ['pending', 'in_progress', 'processing']);
    }
    
    /**
     * 链式操作：获取采集信息并继续处理
     *
     * @param callable $callback 处理采集信息的回调
     * @return self
     */
    public function processCollect(callable $callback): self
    {
        if ($this->isSuccess()) {
            $collectData = [
                'taskId' => $this->getTaskId(),
                'orgId' => $this->getOrgId(),
                'status' => $this->getStatus(),
                'progress' => $this->getProgress(),
                'dataType' => $this->getDataType(),
                'details' => $this->getDetails(),
                'data' => $this->getData(),
                'taxData' => $this->getTaxData(),
                'invoiceData' => $this->getInvoiceData(),
                'isCollectSuccess' => $this->isCollectSuccess(),
                'isInProgress' => $this->isInProgress()
            ];
            
            return $callback($collectData, $this);
        }
        
        return $this;
    }
}