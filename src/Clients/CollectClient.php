<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\CollectResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 企业采集客户端
 * 处理企业数据采集相关业务
 */
class CollectClient extends BaseClient
{
    protected $clientName = 'collect';
    
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
     * 发起企业数据采集
     * 
     * @param array $params 采集参数
     * @return CollectResponse
     * @throws QixiangyunException
     */
    public function beginFinTask(array $params): CollectResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestCollectResponse('/v2/collect/beginFinTask', $params);
    }
    
    /**
     * 获取采集状态信息
     * 
     * @param array $params 查询参数
     * @return CollectResponse
     * @throws QixiangyunException
     */
    public function taskStatusDetails(array $params): CollectResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCollectResponse('/v2/collect/taskStatusDetails', $params);
    }
    
    /**
     * 获取采集状态及全量数据
     * 
     * @param array $params 查询参数
     * @return CollectResponse
     * @throws QixiangyunException
     */
    public function getTaxAndFpInfo(array $params): CollectResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestCollectResponse('/v2/collect/getTaxAndFpInfo', $params);
    }
    
    /**
     * 获取税务数据
     * 
     * @param array $params 查询参数
     * @return CollectResponse
     * @throws QixiangyunException
     */
    public function getTaxInfo(array $params): CollectResponse
    {
        $this->validateParams($params, ['taskId', 'dataType']);
        
        return $this->requestCollectResponse('/v2/collect/tax/getTaxInfo', $params);
    }
    
    /**
     * 获取发票数据
     * 
     * @param array $params 查询参数
     * @return CollectResponse
     * @throws QixiangyunException
     */
    public function getCollectTaskPageData(array $params): CollectResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCollectResponse('/v2/collect/invoice/getCollectTaskPageData', $params);
    }
}
