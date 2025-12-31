<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\PhoneResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 办税小号客户端
 * 处理办税小号相关业务
 */
class PhoneClient extends BaseClient
{
    protected $clientName = 'phone';
    
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
     * 申请小号订单
     * 
     * @param array $params 订单参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function createOrder(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orgId', 'accountCount']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/createBsxhOrder', $params);
    }
    
    /**
     * 查询小号订单详情
     * 
     * @param array $params 查询参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function queryOrder(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/queryBsxhOrder', $params);
    }
    
    /**
     * 配置小号订单开通通知地址
     * 
     * @param array $params 配置参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function editPushUrl(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId', 'pushUrl']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/editBsxhOrderPushUrlConfig', $params);
    }
    
    /**
     * 绑定实名手机号与办税小号
     * 
     * @param array $params 绑定参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function bind(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId', 'phoneNumber', 'taxNo']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/bindAxn', $params);
    }
    
    /**
     * 更换绑定的实名手机号
     * 
     * @param array $params 更新参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function updatePhone(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId', 'newPhoneNumber', 'taxNo']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/updateNoA', $params);
    }
    
    /**
     * 解除实名手机号与办税小号绑定
     * 
     * @param array $params 解绑参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function unbind(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId', 'taxNo']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/unbind', $params);
    }
    
    /**
     * 办税小号通话清单查询
     * 
     * @param array $params 查询参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function queryCallList(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/querySecretReportPageList', $params);
    }
    
    /**
     * 查询短信验证码
     * 
     * @param array $params 查询参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function querySmsCode(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/queryNote', $params);
    }
    
    /**
     * 配置小号短信通知地址
     * 
     * @param array $params 配置参数
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    public function editSmsPushUrl(array $params): PhoneResponse
    {
        $this->validateParams($params, ['orderId', 'pushUrl']);
        
        return $this->requestPhoneResponse('/v2/public/sjhm/editPushSmsConfig', $params);
    }
}
