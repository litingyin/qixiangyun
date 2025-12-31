<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 风险查询客户端
 * 处理企业风险查询相关业务
 */
class RiskClient extends BaseClient
{
    protected $clientName = 'risk';
    
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
     * 查询企业是否黑名单
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function standard(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/standard', $params);
    }
    
    /**
     * 企业风控明细接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function qyfkmx(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/qyfkmx', $params);
    }
    
    /**
     * 经营异常风险接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function jyyc(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/jyyc', $params);
    }
    
    /**
     * 严重违法风险接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function yzwf(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/yzwf', $params);
    }
    
    /**
     * 重大税收违法风险接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function zdsswf(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/zdsswf', $params);
    }
    
    /**
     * 非正常户接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function fzchnew(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/fzchnew', $params);
    }
    
    /**
     * 查询企业是否黑名单（增强版）
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function plus(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/plus', $params);
    }
    
    /**
     * 云抬头查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function qycx(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/qycx', $params);
    }
    
    /**
     * 企业精准查询接口
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function qycxnew(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/risk/hmd/qycxnew', $params);
    }
}
