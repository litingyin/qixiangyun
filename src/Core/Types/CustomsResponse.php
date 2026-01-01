<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 海关响应类
 * 提供海关相关API的返回值类型定义
 */
class CustomsResponse extends Response
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
     * 获取文档ID
     *
     * @return string
     */
    public function getDocumentId(): string
    {
        return $this->get('documentId', '');
    }
    
    /**
     * 获取文件URL
     *
     * @return string
     */
    public function getFileUrl(): string
    {
        return $this->get('fileUrl', '');
    }
    
    /**
     * 获取报关单数据
     *
     * @return array
     */
    public function getCustomsData(): array
    {
        return $this->get('customsData', []);
    }
    
    /**
     * 检查海关响应是否成功
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getData());
    }
    
    /**
     * 链式操作：获取海关信息并继续处理
     *
     * @param callable $callback 处理海关信息的回调
     * @return self
     */
    public function processCustoms(callable $callback): self
    {
        if ($this->isValid()) {
            $customsData = [
                'taskId' => $this->getTaskId(),
                'aggOrgId' => $this->getaggOrgId(),
                'documentId' => $this->getDocumentId(),
                'fileUrl' => $this->getFileUrl(),
                'customsData' => $this->getCustomsData()
            ];
            
            return $callback($customsData, $this);
        }
        
        return $this;
    }
}