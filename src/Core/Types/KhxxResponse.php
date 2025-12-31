<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 客户信息响应类型
 * 提供客户信息管理相关的链式操作方法
 */
class KhxxResponse extends BaseResponse
{
    /**
     * 处理客户分类信息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processCategory(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理客户信息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processCustomer(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 验证客户分类
     *
     * @param callable $validator 验证函数
     * @return self
     */
    public function validateCategory(callable $validator): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            $isValid = $validator($this->data['data'], $this);
            if (!$isValid) {
                $this->success = false;
                $this->error = '客户分类验证失败';
            }
        }
        return $this;
    }

    /**
     * 验证客户信息
     *
     * @param callable $validator 验证函数
     * @return self
     */
    public function validateCustomer(callable $validator): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            $isValid = $validator($this->data['data'], $this);
            if (!$isValid) {
                $this->success = false;
                $this->error = '客户信息验证失败';
            }
        }
        return $this;
    }
    
    /**
     * 提取分类列表
     * 
     * @return array
     */
    public function getCategoryList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取客户列表
     * 
     * @return array
     */
    public function getCustomerList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取客户总数
     * 
     * @return int
     */
    public function getTotalCount(): int
    {
        if (!$this->isSuccess() || !isset($this->data['data']['total'])) {
            return 0;
        }
        return (int)$this->data['data']['total'];
    }
    
    /**
     * 过滤客户分类
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterCategories(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 过滤客户信息
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterCustomers(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 排序客户分类
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortCategories(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 排序客户信息
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortCustomers(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 限制返回的客户分类数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitCategories(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 限制返回的客户信息数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitCustomers(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 格式化客户分类显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatCategories(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$category) {
                $category = $formatter($category, $this);
            }
        }
        return $this;
    }
    
    /**
     * 格式化客户信息显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatCustomers(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$customer) {
                $customer = $formatter($customer, $this);
            }
        }
        return $this;
    }
    
    /**
     * 提取分类ID列表
     * 
     * @return array
     */
    public function getCategoryIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $category) {
                if (isset($category['id'])) {
                    $ids[] = $category['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取客户ID列表
     * 
     * @return array
     */
    public function getCustomerIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $customer) {
                if (isset($customer['id'])) {
                    $ids[] = $customer['id'];
                }
            }
        }
        return $ids;
    }
}