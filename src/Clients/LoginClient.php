<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Core\Types\LoginResponse;

class LoginClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'LoginClient';
    }
    
    /**
     * 税务APP登录发送短信验证码
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function remoteEtaxcookie(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/public/login/remote/etaxcookie', $params);
    }
    
    /**
     * 税务APP登录上传短信验证码
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function remotePushsms(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/remote/pushsms', $params);
    }
    
    /**
     * 校验税务APP是否能快速登录
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function checkRomoteAppCache(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/remote/checkRomoteAppCache', $params);
    }
    
    /**
     * 校验税局缓存是否有效
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function checkCache(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/remote/checkCache', $params);
    }
    
    /**
     * 账密检查接口
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function checkAccount(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/checkAccount', $params);
    }
    
    /**
     * 代理登录获取企业列表
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function proxyOrgList(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/agent/login/proxyOrgList', $params);
    }
    
    /**
     * 登录税局发送短信验证码
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function extEtaxcookie(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/ext/etaxcookie', $params);
    }
    
    /**
     * 登录税局上传短信验证码
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function extEtaxpushsms(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/ext/etaxpushsms', $params);
    }
    
    /**
     * 校验税局缓存是否有效
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function checkAsyncLoginSjCache(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/ext/checkAsyncLoginSjCache', $params);
    }
    
    /**
     * 获取登录税局二维码
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function getQrcode(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/scanLogin/getQrcode', $params);
    }
    
    /**
     * 扫二维码登录税局
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function qrcodeLogin(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/scanLogin/qrcodeLogin', $params);
    }
    
    /**
     * 登出
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function loginOut(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/ext/loginOut', $params);
    }
    
    /**
     * 上传Cookie接口
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function uploadToken(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/ext/uploadToken', $params);
    }
    
    /**
     * 停用账号启用
     *
     * @param array $params 参数
     * @return LoginResponse
     */
    public function recoveryLogin(array $params): LoginResponse
    {
        return $this->requestLoginResponse('v2/public/login/recoveryLogin', $params);
    }
}