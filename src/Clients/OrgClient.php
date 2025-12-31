<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\OrgResponse;

class OrgClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'OrgClient';
    }
    
    /**
     * 订购产品
     *
     * @param array $params 订购参数
     * @return OrgResponse
     */
    public function productPurchase(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/productPurchase', $params);
    }
    
    /**
     * 订购修改
     *
     * @param array $params 修改参数
     * @return OrgResponse
     */
    public function productPurchaseModify(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/productPurchaseModify', $params);
    }
    
    /**
     * 订购取消
     *
     * @param array $params 取消参数
     * @return OrgResponse
     */
    public function productCancel(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/productCancel', $params);
    }
    
    /**
     * 订购查询
     *
     * @param array $params 查询参数
     * @return OrgResponse
     */
    public function productList(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/productList', $params);
    }
    
    /**
     * 企业取消授权
     *
     * @param array $params 参数
     * @return OrgResponse
     */
    public function delete(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/delete', $params);
    }
    
    /**
     * 自然人获取企业列表
     *
     * @param array $params 查询参数
     * @return OrgResponse
     */
    public function queryOrglist(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/zrr/queryOrglist', $params);
    }
    
    /**
     * 发起企业基本信息
     *
     * @param array $params 参数
     * @return OrgResponse
     */
    public function beginOrgInfoTask(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/beginOrgInfoTask', $params);
    }
    
    /**
     * 获取企业基本信息
     *
     * @param array $params 查询参数
     * @return OrgResponse
     */
    public function queryOrgInfoTask(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/queryOrgInfoTask', $params);
    }
    
    /**
     * 发起采集企业税务信息
     *
     * @param array $params 参数
     * @return OrgResponse
     */
    public function loadOrgTaxInfo(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/loadOrgTaxInfo', $params);
    }
    
    /**
     * 查询企业税务信息状态
     *
     * @param array $params 参数
     * @return OrgResponse
     */
    public function hasReadSJInfo(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/hasReadSJInfo', $params);
    }
    
    /**
     * 查询企业信息
     *
     * @param array $params 参数
     * @return OrgResponse
     */
    public function queryOrgInfo(array $params): OrgResponse
    {
        return $this->requestOrgResponse('v2/public/org/queryOrgInfo', $params);
    }
}