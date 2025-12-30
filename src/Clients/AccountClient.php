<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;

class AccountClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'AccountClient';
    }
    
    /**
     * 通用账号创建/修改
     *
     * @param array $params 参数
     * @return array
     */
    public function createBaseAccount(array $params): array
    {
        return $this->httpClient->post('v2/public/account/createBaseAccount', $params);
    }
    
    /**
     * 托管账号创建
     *
     * @param array $params 参数
     * @return array
     */
    public function create(array $params): array
    {
        return $this->httpClient->post('v2/public/account/create', $params);
    }
    
    /**
     * 托管账号修改
     *
     * @param array $params 参数
     * @return array
     */
    public function update(array $params): array
    {
        return $this->httpClient->post('v2/public/account/update', $params);
    }
    
    /**
     * 托管账号删除
     *
     * @param array $params 参数
     * @return array
     */
    public function delete(array $params): array
    {
        return $this->httpClient->post('v2/public/account/delete', $params);
    }
    
    /**
     * 托管账号查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryAccount(array $params): array
    {
        return $this->httpClient->post('v2/public/account/queryAccount', $params);
    }
    
    /**
     * 账号产品绑定
     *
     * @param array $params 参数
     * @return array
     */
    public function bindAccountProduct(array $params): array
    {
        return $this->httpClient->post('v2/public/account/bindAccountProduct', $params);
    }
    
    /**
     * 账号产品解绑
     *
     * @param array $params 参数
     * @return array
     */
    public function unbindAccountProduct(array $params): array
    {
        return $this->httpClient->post('v2/public/account/unbindAccountProduct', $params);
    }
    
    /**
     * 账号批量绑定产品
     *
     * @param array $params 参数
     * @return array
     */
    public function bindAccountProducts(array $params): array
    {
        return $this->httpClient->post('v2/public/account/bindAccountProducts', $params);
    }
}