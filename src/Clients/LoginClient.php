<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;

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
     * @return array
     */
    public function remoteEtaxcookie(array $params): array
    {
        return $this->httpClient->post('v2/public/login/remote/etaxcookie', $params);
    }
    
    /**
     * 税务APP登录上传短信验证码
     *
     * @param array $params 参数
     * @return array
     */
    public function remotePushsms(array $params): array
    {
        return $this->httpClient->post('v2/public/login/remote/pushsms', $params);
    }
    
    /**
     * 校验税务APP是否能快速登录
     *
     * @param array $params 参数
     * @return array
     */
    public function checkRomoteAppCache(array $params): array
    {
        return $this->httpClient->post('v2/public/login/remote/checkRomoteAppCache', $params);
    }
    
    /**
     * 校验税局缓存是否有效
     *
     * @param array $params 参数
     * @return array
     */
    public function checkCache(array $params): array
    {
        return $this->httpClient->post('v2/public/login/remote/checkCache', $params);
    }
    
    /**
     * 账密检查接口
     *
     * @param array $params 参数
     * @return array
     */
    public function checkAccount(array $params): array
    {
        return $this->httpClient->post('v2/public/login/checkAccount', $params);
    }
    
    /**
     * 代理登录获取企业列表
     *
     * @param array $params 参数
     * @return array
     */
    public function proxyOrgList(array $params): array
    {
        return $this->httpClient->post('v2/public/agent/login/proxyOrgList', $params);
    }
    
    /**
     * 登录税局发送短信验证码
     *
     * @param array $params 参数
     * @return array
     */
    public function extEtaxcookie(array $params): array
    {
        return $this->httpClient->post('v2/public/login/ext/etaxcookie', $params);
    }
    
    /**
     * 登录税局上传短信验证码
     *
     * @param array $params 参数
     * @return array
     */
    public function extEtaxpushsms(array $params): array
    {
        return $this->httpClient->post('v2/public/login/ext/etaxpushsms', $params);
    }
    
    /**
     * 校验税局缓存是否有效
     *
     * @param array $params 参数
     * @return array
     */
    public function checkAsyncLoginSjCache(array $params): array
    {
        return $this->httpClient->post('v2/public/login/ext/checkAsyncLoginSjCache', $params);
    }
    
    /**
     * 获取登录税局二维码
     *
     * @param array $params 参数
     * @return array
     */
    public function getQrcode(array $params): array
    {
        return $this->httpClient->post('v2/public/login/scanLogin/getQrcode', $params);
    }
    
    /**
     * 扫二维码登录税局
     *
     * @param array $params 参数
     * @return array
     */
    public function qrcodeLogin(array $params): array
    {
        return $this->httpClient->post('v2/public/login/scanLogin/qrcodeLogin', $params);
    }
    
    /**
     * 登出
     *
     * @param array $params 参数
     * @return array
     */
    public function loginOut(array $params): array
    {
        return $this->httpClient->post('v2/public/login/ext/loginOut', $params);
    }
    
    /**
     * 上传Cookie接口
     *
     * @param array $params 参数
     * @return array
     */
    public function uploadToken(array $params): array
    {
        return $this->httpClient->post('v2/public/login/ext/uploadToken', $params);
    }
    
    /**
     * 停用账号启用
     *
     * @param array $params 参数
     * @return array
     */
    public function recoveryLogin(array $params): array
    {
        return $this->httpClient->post('v2/public/login/recoveryLogin', $params);
    }
}