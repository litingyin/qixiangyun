<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\GjResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 发票归集客户端
 * 处理发票归集相关业务
 */
class GjClient extends BaseClient
{
    protected $clientName = 'gj';
    
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
     * 申请全量发票汇总信息
     * 
     * @param array $params 申请参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function applyInvoiceSummary(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/queryFpsljeseHj', $params);
    }
    
    /**
     * 获取全量发票汇总信息
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function getInvoiceSummary(array $params): GjResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/getFpsljeseHj', $params);
    }
    
    /**
     * 发起进销项归集任务
     * 
     * @param array $params 任务参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function collectTask(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId', 'type']);
        
        return $this->requestGjResponse('/v2/invoice/gj/collectTask', $params);
    }
    
    /**
     * 查询归集任务结果
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function queryCollectTaskStatus(array $params): GjResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/collectTaskStatus', $params);
    }
    
    /**
     * 获取发票数据
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function getCollectTaskPageData(array $params): GjResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/getCollectTaskPageData', $params);
    }
    
    /**
     * 发起作废/红冲归集任务
     * 
     * @param array $params 任务参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function redInvoiceCollectTask(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/redInvoiceCollectTask', $params);
    }
    
    /**
     * 发起已勾选归集任务
     * 
     * @param array $params 任务参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function collectCheckedInvoice(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/collectCheckedInvoice', $params);
    }
    
    /**
     * 查询已勾选归集任务结果
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function collectCheckedInvoiceStatus(array $params): GjResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/collectCheckedInvoiceStatus', $params);
    }
    
    /**
     * 查询已勾选归集数据
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getCollectCheckedInvoicePageData(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/invoice/gj/getCollectCheckedInvoicePageData', $params);
    }
    
    /**
     * 撤销归集待执行任务
     * 
     * @param array $params 撤销参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function terminateCollectionTask(array $params): GjResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/terminateCollectionTask', $params);
    }
    
    /**
     * 进销项发票信息
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function syncCollectTask(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/syncCollectTask', $params);
    }
    
    /**
     * 发票基础信息
     * 
     * @param array $params 查询参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function syncFpjbxx(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestGjResponse('/v2/invoice/gj/syncFpjbxx', $params);
    }
    
    /**
     * 发票详情归集
     * 
     * @param array $params 归集参数
     * @return GjResponse
     * @throws QixiangyunException
     */
    public function collectFpmx(array $params): GjResponse
    {
        $this->validateParams($params, ['orgId', 'fpdm', 'fphm']);
        
        return $this->requestGjResponse('/v2/invoice/gj/fpmx', $params);
    }
}
