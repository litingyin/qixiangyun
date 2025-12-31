<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 政策法规响应类型
 * 提供政策法规管理相关的链式操作方法
 */
class LegislationResponse extends BaseResponse
{
    /**
     * 处理政策分类信息
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
     * 处理政策属性信息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processAttribute(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理政策列表
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processPolicyList(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理政策详情
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processPolicyDetail(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理文件URL
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processFileUrl(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
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
     * 提取属性列表
     * 
     * @return array
     */
    public function getAttributeList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取政策列表
     * 
     * @return array
     */
    public function getPolicyList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取政策详情
     * 
     * @return array
     */
    public function getPolicyDetail(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data'])) {
            return [];
        }
        return $this->data['data'];
    }
    
    /**
     * 提取文件URL
     * 
     * @return string
     */
    public function getFileUrl(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['url'])) {
            return '';
        }
        return $this->data['data']['url'];
    }
    
    /**
     * 提取政策总数
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
     * 过滤政策分类
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
     * 过滤政策属性
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterAttributes(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 过滤政策列表
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterPolicies(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 排序政策分类
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
     * 排序政策属性
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortAttributes(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 排序政策列表
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortPolicies(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 限制返回的政策分类数量
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
     * 限制返回的政策属性数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitAttributes(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 限制返回的政策列表数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitPolicies(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 格式化政策分类显示
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
     * 格式化政策属性显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatAttributes(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$attribute) {
                $attribute = $formatter($attribute, $this);
            }
        }
        return $this;
    }
    
    /**
     * 格式化政策列表显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatPolicies(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$policy) {
                $policy = $formatter($policy, $this);
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
     * 提取属性ID列表
     * 
     * @return array
     */
    public function getAttributeIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $attribute) {
                if (isset($attribute['id'])) {
                    $ids[] = $attribute['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取政策ID列表
     * 
     * @return array
     */
    public function getPolicyIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $policy) {
                if (isset($policy['id'])) {
                    $ids[] = $policy['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取政策标题列表
     * 
     * @return array
     */
    public function getPolicyTitles(): array
    {
        $titles = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $policy) {
                if (isset($policy['title'])) {
                    $titles[] = $policy['title'];
                }
            }
        }
        return $titles;
    }
}