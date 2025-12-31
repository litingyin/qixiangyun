<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 基础响应类
 * 提供通用API的返回值类型定义
 */
class BaseResponse extends Response
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
     * 获取状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取消息
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->get('message', '');
    }
    
    /**
     * 获取代码
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->get('code', '');
    }
    
    /**
     * 获取数据
     *
     * @return array
     */
    public function getData(): array
    {
        return parent::getData();
    }
    
    /**
     * 检查响应是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess();
    }
    
    /**
     * 链式操作：获取信息并继续处理
     *
     * @param callable $callback 处理信息的回调
     * @return self
     */
    public function process(callable $callback): self
    {
        if ($this->isValid()) {
            $data = [
                'taskId' => $this->getTaskId(),
                'status' => $this->getStatus(),
                'message' => $this->getMessage(),
                'code' => $this->getCode(),
                'data' => $this->getData()
            ];
            
            return $callback($data, $this);
        }
        
        return $this;
    }
}