<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\CustomsResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 海关客户端
 * 处理海关相关业务
 */
class CustomsClient extends BaseClient
{
    protected $clientName = 'customs';
    
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
     * 退税报关单
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQTSBGD2(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQTSBGD2', $params);
    }
    
    /**
     * 退税联PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getTSBGD_PRINT(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getTSBGD_PRINT', $params);
    }
    
    /**
     * 进出口报关单
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQJCKBGD(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQJCKBGD', $params);
    }
    
    /**
     * 放行通知书PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQTGWZHCKFXTZS_PDF(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQTGWZHCKFXTZS_PDF', $params);
    }
    
    /**
     * 电子委托协议PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQDZWTXY_PDF(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQDZWTXY_PDF', $params);
    }
    
    /**
     * 购销合同PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQGXHT_PDF(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQGXHT_PDF', $params);
    }
    
    /**
     * 装箱单PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getHQZXD_PDF(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getHQZXD_PDF', $params);
    }
    
    /**
     * 获取预录入报关单PDF
     * 
     * @param array $params 查询参数
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    public function getRLR_PDF(array $params): CustomsResponse
    {
        $this->validateParams($params, ['aggOrgId', 'documentId']);
        
        return $this->requestCustomsResponse('/v2/customs/imex/dzh/getRLR_PDF', $params);
    }
}
