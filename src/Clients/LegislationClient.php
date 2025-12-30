<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 政策法规客户端
 * 处理政策法规相关业务
 */
class LegislationClient extends BaseClient
{
    protected $clientName = 'legislation';
    
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
     * 政策分类查询接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function category(array $params = [])
    {
        return $this->request('/v2/legislation/category', $params);
    }
    
    /**
     * 政策属性查询接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function attrList(array $params = [])
    {
        return $this->request('/v2/legislation/attrList', $params);
    }
    
    /**
     * 政策列表分页接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function listPage(array $params = [])
    {
        return $this->request('/v2/legislation/listPage', $params);
    }
    
    /**
     * 政策详情查询接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function detail(array $params)
    {
        $this->validateParams($params, ['policyId']);
        
        return $this->request('/v2/legislation/detail', $params);
    }
    
    /**
     * 获取政策附件文件下载地址
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getFileUrl(array $params)
    {
        $this->validateParams($params, ['fileId']);
        
        return $this->request('/v2/legislation/getFileUrl', $params);
    }
}
