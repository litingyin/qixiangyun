<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\FpruzResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 发票入账客户端
 * 处理发票入账相关业务
 */
class FpruzClient extends BaseClient
{
    protected $clientName = 'fpruz';
    
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
     * 发票入账信息查询
     * 
     * @param array $params 查询参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function queryInvoiceAccountingInfo(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/queryFprzxx', $params);
    }
    
    /**
     * 发票入账
     * 
     * @param array $params 入账参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function invoiceAccounting(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId', 'invoiceId', 'accountingStatus']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/fprzbc', $params);
    }
    
    /**
     * 海关缴款书入账信息查询
     * 
     * @param array $params 查询参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function queryCustomsAccountingInfo(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/queryHgjksrzxx', $params);
    }
    
    /**
     * 海关缴款书入账
     * 
     * @param array $params 入账参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function customsAccounting(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId', 'customsId', 'accountingStatus']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/hgjksrzbc', $params);
    }
    
    /**
     * 代扣代缴入账信息查询
     * 
     * @param array $params 查询参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function queryWithholdingAccountingInfo(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/queryDkdjrzxx', $params);
    }
    
    /**
     * 代扣代缴入账
     * 
     * @param array $params 入账参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function withholdingAccounting(array $params): FpruzResponse
    {
        $this->validateParams($params, ['aggOrgId', 'withholdingId', 'accountingStatus']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/dkdjrzbc', $params);
    }
    
    /**
     * 异步请求结果查询
     * 
     * @param array $params 查询参数
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    public function queryAsyncResult(array $params): FpruzResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestFpruzResponse('/v2/invoice/fpruz/asynResult', $params);
    }
}
