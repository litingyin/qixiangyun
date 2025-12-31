<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 产品管理响应类
 * 提供产品管理相关API的返回值类型定义
 */
class ProductResponse extends Response
{
    /**
     * 获取产品ID
     *
     * @return string
     */
    public function getProductId(): string
    {
        return $this->get('productId', '');
    }
    
    /**
     * 获取产品名称
     *
     * @return string
     */
    public function getProductName(): string
    {
        return $this->get('productName', '');
    }
    
    /**
     * 获取产品代码
     *
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->get('productCode', '');
    }
    
    /**
     * 获取产品价格
     *
     * @return float
     */
    public function getPrice(): float
    {
        return (float) $this->get('price', 0);
    }
    
    /**
     * 获取产品描述
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->get('description', '');
    }
    
    /**
     * 获取产品状态
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status', '');
    }
    
    /**
     * 获取创建时间
     *
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->get('createTime', '');
    }
    
    /**
     * 获取更新时间
     *
     * @return string
     */
    public function getUpdateTime(): string
    {
        return $this->get('updateTime', '');
    }
    
    /**
     * 检查产品是否有效
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isSuccess() && !empty($this->getProductId());
    }
    
    /**
     * 检查产品是否激活
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getStatus() === 'active';
    }
    
    /**
     * 链式操作：获取产品信息并继续处理
     *
     * @param callable $callback 处理产品信息的回调
     * @return self
     */
    public function processProduct(callable $callback): self
    {
        if ($this->isValid()) {
            $productData = [
                'id' => $this->getProductId(),
                'name' => $this->getProductName(),
                'code' => $this->getProductCode(),
                'price' => $this->getPrice(),
                'description' => $this->getDescription(),
                'status' => $this->getStatus(),
                'isActive' => $this->isActive(),
                'createTime' => $this->getCreateTime(),
                'updateTime' => $this->getUpdateTime()
            ];
            
            return $callback($productData, $this);
        }
        
        return $this;
    }
}