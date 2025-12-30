<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;

class BsryglClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'BsryglClient';
    }
    
    /**
     * 企业添加办税人员任务
     *
     * @param array $params 参数
     * @return array
     */
    public function addBsyTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/addBsyTask', $params);
    }
    
    /**
     * 企业添加办税人员结果查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryBsyTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/queryBsyTask', $params);
    }
    
    /**
     * 获取二维码
     *
     * @param array $params 参数
     * @return array
     */
    public function getQrcode(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/common/getQrcode', $params);
    }
    
    /**
     * 二维码状态确认
     *
     * @param array $params 参数
     * @return array
     */
    public function getQrcodeState(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/common/getQrcodeState', $params);
    }
    
    /**
     * 企业现有办税人员获取
     *
     * @param array $params 参数
     * @return array
     */
    public function bsyInfoTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/bsyInfoTask', $params);
    }
    
    /**
     * 企业现有办税人员结果查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryBsyInfoTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/queryBsyInfoTask', $params);
    }
    
    /**
     * 企业删除办税人员
     *
     * @param array $params 参数
     * @return array
     */
    public function delBsyTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/delBsyTask', $params);
    }
    
    /**
     * 现有办税人员删除记录任务
     *
     * @param array $params 参数
     * @return array
     */
    public function bsyDeletedTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/bsyDeletedTask', $params);
    }
    
    /**
     * 企业删除办税人员结果查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryDelBsyTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/queryDelBsyTask', $params);
    }
    
    /**
     * 现有办税人员删除记录任务查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryBsyDeletedTask(array $params): array
    {
        return $this->httpClient->post('v2/bsrygl/qy/queryBsyDeletedTask', $params);
    }
}