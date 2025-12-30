<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 认证客户端
 * 处理认证相关业务
 */
class RzClient extends BaseClient
{
    protected $clientName = 'rz';
    
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
     * 获取税款所属期
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getTaxPeriod(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/rz/sbxx', $params);
    }
    
    /**
     * 申请税款所属期采集
     * 
     * @param array $params 申请参数
     * @return array
     * @throws QixiangyunException
     */
    public function applyTaxPeriodCollect(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/rz/sqSkssqCj', $params);
    }
    
    /**
     * 获取税款所属期任务结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxPeriodResult(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/invoice/rz/skssqCjjg', $params);
    }
    
    /**
     * 进项发票取数
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryInputInvoice(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/rz/jxfpqs', $params);
    }
    
    /**
     * 申请进项发票采集
     * 
     * @param array $params 申请参数
     * @return array
     * @throws QixiangyunException
     */
    public function applyInputInvoiceCollect(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/rz/sqJxfpCj', $params);
    }
    
    /**
     * 进项发票采集结果查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryInputInvoiceResult(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/invoice/rz/jxfpCjjg', $params);
    }
    
    /**
     * 申请海关缴款书采集
     * 
     * @param array $params 申请参数
     * @return array
     * @throws QixiangyunException
     */
    public function applyCustomsCollect(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/rz/sqHgjksCj', $params);
    }
    
    /**
     * 海关缴款书采集结果查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryCustomsCollectResult(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/invoice/rz/hgjksCjjg', $params);
    }
}
