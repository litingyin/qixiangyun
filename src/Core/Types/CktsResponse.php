<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 出口退税响应类
 * 提供出口退税相关API的返回值类型定义
 */
class CktsResponse extends Response
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
     * 获取申报状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
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
     * 获取申报期间
     *
     * @return string
     */
    public function getTaxPeriod(): string
    {
        return $this->get('taxPeriod', '');
    }
    
    /**
     * 获取申报ID
     *
     * @return string
     */
    public function getDeclareId(): string
    {
        return $this->get('declareId', '');
    }
    
    /**
     * 获取审核状态
     *
     * @return string
     */
    public function getReviewStatus(): string
    {
        return $this->get('reviewStatus', '');
    }
    
    /**
     * 获取文件下载URL
     *
     * @return string
     */
    public function getFileUrl(): string
    {
        return $this->get('fileUrl', '');
    }
    
    /**
     * 获取反馈信息
     *
     * @return array
     */
    public function getFeedback(): array
    {
        return $this->get('feedback', []);
    }
    
    /**
     * 检查出口退税申报是否成功
     *
     * @return bool
     */
    public function isDeclarationSuccess(): bool
    {
        return $this->isSuccess() && in_array($this->getStatus(), ['success', 'completed']);
    }
    
    /**
     * 检查是否需要审核
     *
     * @return bool
     */
    public function needsReview(): bool
    {
        return in_array($this->getReviewStatus(), ['pending', 'in_progress']);
    }
    
    /**
     * 链式操作：获取出口退税信息并继续处理
     *
     * @param callable $callback 处理出口退税信息的回调
     * @return self
     */
    public function processCkts(callable $callback): self
    {
        if ($this->isSuccess()) {
            $cktsData = [
                'taskId' => $this->getTaskId(),
                'status' => $this->getStatus(),
                'orgId' => $this->getOrgId(),
                'taxPeriod' => $this->getTaxPeriod(),
                'declareId' => $this->getDeclareId(),
                'reviewStatus' => $this->getReviewStatus(),
                'fileUrl' => $this->getFileUrl(),
                'feedback' => $this->getFeedback(),
                'isDeclarationSuccess' => $this->isDeclarationSuccess(),
                'needsReview' => $this->needsReview()
            ];
            
            return $callback($cktsData, $this);
        }
        
        return $this;
    }
}