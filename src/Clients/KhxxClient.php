<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 客户信息客户端
 * 处理客户信息管理业务
 */
class KhxxClient extends BaseClient
{
    protected $clientName = 'khxx';
    
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
     * 客户分类查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryCategoryList(array $params = [])
    {
        return $this->request('/v2/invoice/qdfp/khxxFlcx', $params);
    }
    
    /**
     * 客户分类新增
     * 
     * @param array $params 分类参数
     * @return array
     * @throws QixiangyunException
     */
    public function addCategory(array $params)
    {
        $this->validateParams($params, ['categoryName']);
        
        return $this->request('/v2/invoice/qdfp/khxxFladd', $params);
    }
    
    /**
     * 客户分类删除
     * 
     * @param array $params 删除参数
     * @return array
     * @throws QixiangyunException
     */
    public function deleteCategory(array $params)
    {
        $this->validateParams($params, ['categoryId']);
        
        return $this->request('/v2/invoice/qdfp/khxxFldel', $params);
    }
    
    /**
     * 客户信息查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryCustomerList(array $params = [])
    {
        return $this->request('/v2/invoice/qdfp/khxxCx', $params);
    }
    
    /**
     * 客户信息新增
     * 
     * @param array $params 客户参数
     * @return array
     * @throws QixiangyunException
     */
    public function addCustomer(array $params)
    {
        $this->validateParams($params, ['customerName', 'taxNo']);
        
        return $this->request('/v2/invoice/qdfp/khxxAdd', $params);
    }
    
    /**
     * 客户信息修改
     * 
     * @param array $params 修改参数
     * @return array
     * @throws QixiangyunException
     */
    public function updateCustomer(array $params)
    {
        $this->validateParams($params, ['customerId']);
        
        return $this->request('/v2/invoice/qdfp/khxxUpdate', $params);
    }
    
    /**
     * 客户信息删除
     * 
     * @param array $params 删除参数
     * @return array
     * @throws QixiangyunException
     */
    public function deleteCustomer(array $params)
    {
        $this->validateParams($params, ['customerId']);
        
        return $this->request('/v2/invoice/qdfp/khxxDel', $params);
    }
}
