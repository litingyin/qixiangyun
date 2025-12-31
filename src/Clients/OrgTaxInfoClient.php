<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\OrgResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 企业税务信息客户端
 * 处理企业税务信息相关业务
 */
class OrgTaxInfoClient extends BaseClient
{
    protected $clientName = 'orgtaxinfo';
    
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
     * 发起采集企业税务信息
     * 
     * @param array $params 采集参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function loadOrgTaxInfo(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestOrgResponse('/v2/public/org/loadOrgTaxInfo', $params);
    }
    
    /**
     * 查询企业税务信息状态
     * 
     * @param array $params 查询参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function queryOrgTaxInfoStatus(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestOrgResponse('/v2/public/org/hasReadSJInfo', $params);
    }
    
    /**
     * 查询企业信息
     * 
     * @param array $params 查询参数
     * @return OrgResponse
     * @throws QixiangyunException
     */
    public function queryOrgInfo(array $params): OrgResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestOrgResponse('/v2/public/org/queryOrgInfo', $params);
    }
}
