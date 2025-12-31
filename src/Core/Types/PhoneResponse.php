<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 办税小号响应类型
 * 提供办税小号管理相关的链式操作方法
 */
class PhoneResponse extends BaseResponse
{
    /**
     * 处理订单信息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processOrder(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理绑定信息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processBinding(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理通话清单
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processCallList(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理短信验证码
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processSmsCode(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }
    
    /**
     * 提取订单ID
     * 
     * @return string
     */
    public function getOrderId(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['orderId'])) {
            return '';
        }
        return (string)$this->data['data']['orderId'];
    }
    
    /**
     * 提取订单状态
     * 
     * @return string
     */
    public function getOrderStatus(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['status'])) {
            return '';
        }
        return (string)$this->data['data']['status'];
    }
    
    /**
     * 提取绑定手机号
     * 
     * @return string
     */
    public function getPhoneNumber(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['phoneNumber'])) {
            return '';
        }
        return (string)$this->data['data']['phoneNumber'];
    }
    
    /**
     * 提取小号
     * 
     * @return string
     */
    public function getSecretNumber(): string
    {
        if (!$this->isSuccess() || !isset($this->data['data']['secretNumber'])) {
            return '';
        }
        return (string)$this->data['data']['secretNumber'];
    }
    
    /**
     * 提取通话列表
     * 
     * @return array
     */
    public function getCallList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取短信验证码
     * 
     * @return array
     */
    public function getSmsCodes(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取总数
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
     * 过滤通话记录
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterCalls(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 过滤短信验证码
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterSmsCodes(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 排序通话记录
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortCalls(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 排序短信验证码
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortSmsCodes(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 限制返回的通话记录数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitCalls(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 限制返回的短信验证码数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitSmsCodes(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 格式化通话记录
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatCalls(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$call) {
                $call = $formatter($call, $this);
            }
        }
        return $this;
    }
    
    /**
     * 格式化短信验证码
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatSmsCodes(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$sms) {
                $sms = $formatter($sms, $this);
            }
        }
        return $this;
    }
    
    /**
     * 提取通话ID列表
     * 
     * @return array
     */
    public function getCallIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $call) {
                if (isset($call['id'])) {
                    $ids[] = $call['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取短信验证码列表
     * 
     * @return array
     */
    public function getSmsCodeList(): array
    {
        $codes = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $sms) {
                if (isset($sms['code'])) {
                    $codes[] = $sms['code'];
                }
            }
        }
        return $codes;
    }
    
    /**
     * 按时间倒序排序通话记录
     * 
     * @return self
     */
    public function sortByTimeDesc(): self
    {
        return $this->sortCalls(function($a, $b) {
            $timeA = isset($a['callTime']) ? strtotime($a['callTime']) : 0;
            $timeB = isset($b['callTime']) ? strtotime($b['callTime']) : 0;
            return $timeB - $timeA;
        });
    }
    
    /**
     * 按时间正序排序通话记录
     * 
     * @return self
     */
    public function sortByTimeAsc(): self
    {
        return $this->sortCalls(function($a, $b) {
            $timeA = isset($a['callTime']) ? strtotime($a['callTime']) : 0;
            $timeB = isset($b['callTime']) ? strtotime($b['callTime']) : 0;
            return $timeA - $timeB;
        });
    }
    
    /**
     * 检查订单是否已完成
     * 
     * @return bool
     */
    public function isOrderCompleted(): bool
    {
        $status = $this->getOrderStatus();
        return $status === 'completed' || $status === 'success';
    }
    
    /**
     * 检查是否已绑定手机号
     * 
     * @return bool
     */
    public function isPhoneBound(): bool
    {
        $phone = $this->getPhoneNumber();
        return !empty($phone);
    }
}