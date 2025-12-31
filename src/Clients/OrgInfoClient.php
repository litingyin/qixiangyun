<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\OrgResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 企业信息采集客户端
 * 处理企业基本信息采集任务
 */
class OrgInfoClient extends BaseClient
{
    protected $clientName = 'orginfo';
    
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
     * 发起企业基本信息采集任务
     * 
     * @param array $params 任务参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function beginTask(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId', 'nsrsbh']);
        
        return $this->requestOrgResponse('/v2/public/beginOrgInfoTask', $params);
    }
    
    /**
     * 获取企业基本信息采集任务结果
     * 
     * @param array $params 查询参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function queryTask(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId', 'taskId']);
        
        return $this->requestOrgResponse('/v2/public/queryOrgInfoTask', $params);
    }
    
    /**
     * 获取企业基本信息
     * 
     * @param array $params 查询参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function getOrgInfo(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestOrgResponse('/v2/public/getOrgInfo', $params);
    }
    
    /**
     * 企业取消授权
     * 
     * @param array $params 取消参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function delete(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestOrgResponse('/v2/public/org/delete', $params);
    }
    
    /**
     * 自然人获取企业列表
     * 
     * @param array $params 查询参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function queryOrglist(array $params = []): OrgResponse
    {
        return $this->requestOrgResponse('/v2/public/zrr/queryOrglist', $params);
    }
}
