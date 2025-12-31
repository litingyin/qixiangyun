<?php

namespace QixiangyunSDK\Core\Types;

/**
 * 消息响应类型
 * 提供消息管理相关的链式操作方法
 */
class MessageResponse extends BaseResponse
{
    /**
     * 处理通知消息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processNotice(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理系统消息
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processSystemMessage(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }

    /**
     * 处理消息已读状态
     *
     * @param callable $callback 处理函数
     * @return self
     */
    public function processReadStatus(callable $callback): self
    {
        if ($this->isSuccess() && isset($this->data['data'])) {
            return $callback($this->data['data'], $this);
        }
        return $this;
    }
    
    /**
     * 提取通知消息列表
     * 
     * @return array
     */
    public function getNoticeList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取系统消息列表
     * 
     * @return array
     */
    public function getSystemMessageList(): array
    {
        if (!$this->isSuccess() || !isset($this->data['data']['list'])) {
            return [];
        }
        return $this->data['data']['list'];
    }
    
    /**
     * 提取消息总数
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
     * 提取未读消息数量
     * 
     * @return int
     */
    public function getUnreadCount(): int
    {
        if (!$this->isSuccess() || !isset($this->data['data']['unreadCount'])) {
            return 0;
        }
        return (int)$this->data['data']['unreadCount'];
    }
    
    /**
     * 提取已读消息数量
     * 
     * @return int
     */
    public function getReadCount(): int
    {
        if (!$this->isSuccess() || !isset($this->data['data']['readCount'])) {
            return 0;
        }
        return (int)$this->data['data']['readCount'];
    }
    
    /**
     * 过滤通知消息
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterNotices(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 过滤系统消息
     * 
     * @param callable $filter 过滤函数
     * @return self
     */
    public function filterSystemMessages(callable $filter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_filter($this->data['data']['list'], $filter);
        }
        return $this;
    }
    
    /**
     * 排序通知消息
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortNotices(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 排序系统消息
     * 
     * @param callable $sorter 排序函数
     * @return self
     */
    public function sortSystemMessages(callable $sorter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            usort($this->data['data']['list'], $sorter);
        }
        return $this;
    }
    
    /**
     * 限制返回的通知消息数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitNotices(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 限制返回的系统消息数量
     * 
     * @param int $limit 限制数量
     * @return self
     */
    public function limitSystemMessages(int $limit): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            $this->data['data']['list'] = array_slice($this->data['data']['list'], 0, $limit);
        }
        return $this;
    }
    
    /**
     * 格式化通知消息显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatNotices(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$notice) {
                $notice = $formatter($notice, $this);
            }
        }
        return $this;
    }
    
    /**
     * 格式化系统消息显示
     * 
     * @param callable $formatter 格式化函数
     * @return self
     */
    public function formatSystemMessages(callable $formatter): self
    {
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as &$message) {
                $message = $formatter($message, $this);
            }
        }
        return $this;
    }
    
    /**
     * 提取通知ID列表
     * 
     * @return array
     */
    public function getNoticeIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $notice) {
                if (isset($notice['id'])) {
                    $ids[] = $notice['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取消息ID列表
     * 
     * @return array
     */
    public function getMessageIds(): array
    {
        $ids = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $message) {
                if (isset($message['id'])) {
                    $ids[] = $message['id'];
                }
            }
        }
        return $ids;
    }
    
    /**
     * 提取消息标题列表
     * 
     * @return array
     */
    public function getMessageTitles(): array
    {
        $titles = [];
        if ($this->isSuccess() && isset($this->data['data']['list'])) {
            foreach ($this->data['data']['list'] as $message) {
                if (isset($message['title'])) {
                    $titles[] = $message['title'];
                }
            }
        }
        return $titles;
    }
    
    /**
     * 过滤未读消息
     * 
     * @return self
     */
    public function onlyUnread(): self
    {
        return $this->filterSystemMessages(function($message) {
            return isset($message['isRead']) && $message['isRead'] === false;
        });
    }
    
    /**
     * 过滤已读消息
     * 
     * @return self
     */
    public function onlyRead(): self
    {
        return $this->filterSystemMessages(function($message) {
            return isset($message['isRead']) && $message['isRead'] === true;
        });
    }
    
    /**
     * 按时间倒序排序
     * 
     * @return self
     */
    public function sortByTimeDesc(): self
    {
        return $this->sortSystemMessages(function($a, $b) {
            $timeA = isset($a['createTime']) ? strtotime($a['createTime']) : 0;
            $timeB = isset($b['createTime']) ? strtotime($b['createTime']) : 0;
            return $timeB - $timeA;
        });
    }
    
    /**
     * 按时间正序排序
     * 
     * @return self
     */
    public function sortByTimeAsc(): self
    {
        return $this->sortSystemMessages(function($a, $b) {
            $timeA = isset($a['createTime']) ? strtotime($a['createTime']) : 0;
            $timeB = isset($b['createTime']) ? strtotime($b['createTime']) : 0;
            return $timeA - $timeB;
        });
    }
    
    /**
     * 检查是否有未读消息
     * 
     * @return bool
     */
    public function hasUnreadMessages(): bool
    {
        return $this->getUnreadCount() > 0;
    }
    
    /**
     * 提取紧急消息
     * 
     * @return array
     */
    public function getUrgentMessages(): array
    {
        $messages = $this->getSystemMessageList();
        return array_filter($messages, function($message) {
            return isset($message['level']) && $message['level'] === 'urgent';
        });
    }
}