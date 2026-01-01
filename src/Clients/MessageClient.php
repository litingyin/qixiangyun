<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\MessageResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 通知和消息客户端
 * 处理服务异常通知等消息功能
 */
class MessageClient extends BaseClient
{
    protected $clientName = 'message';
    
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }
    
    /**
     * 获取服务异常通知
     * 
     * @param array $params 查询参数
     * @return MessageResponse
     * @throws QixiangyunException
     */
    public function getNotice(array $params): MessageResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestMessageResponse('/v2/subscribe/sysmessage/getNoticeMessage', $params);
    }
    
    /**
     * 获取系统消息列表
     * 
     * @param array $params 查询参数
     * @return MessageResponse
     * @throws QixiangyunException
     */
    public function getSysMessageList(array $params = []): MessageResponse
    {
        return $this->requestMessageResponse('/v2/public/sysmessage/list', $params);
    }
    
    /**
     * 标记消息已读
     * 
     * @param array $params 消息参数
     * @return MessageResponse
     * @throws QixiangyunException
     */
    public function markAsRead(array $params): MessageResponse
    {
        $this->validateParams($params, ['messageId']);
        
        return $this->requestMessageResponse('/v2/public/sysmessage/markRead', $params);
    }
    
    /**
     * 批量标记消息已读
     * 
     * @param array $params 消息参数
     * @return MessageResponse
     * @throws QixiangyunException
     */
    public function batchMarkAsRead(array $params): MessageResponse
    {
        $this->validateParams($params, ['messageIds']);
        
        return $this->requestMessageResponse('/v2/public/sysmessage/batchMarkRead', $params);
    }
    
    /**
     * 删除消息
     * 
     * @param array $params 消息参数
     * @return MessageResponse
     * @throws QixiangyunException
     */
    public function deleteMessage(array $params): MessageResponse
    {
        $this->validateParams($params, ['messageId']);
        
        return $this->requestMessageResponse('/v2/public/sysmessage/delete', $params);
    }
}
