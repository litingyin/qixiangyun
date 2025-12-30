<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 商品信息客户端
 * 处理商品信息、客户信息等管理业务
 */
class SpxxClient extends BaseClient
{
    protected $clientName = 'spxx';
    
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
     * 品名查询税收分类信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxInfoByName(array $params)
    {
        $this->validateParams($params, ['productName']);
        
        return $this->request('/v2/invoice/qdfp/spxxZnFm', $params);
    }
    
    /**
     * 税编查询税收分类信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxInfoByCode(array $params)
    {
        $this->validateParams($params, ['taxCode']);
        
        return $this->request('/v2/invoice/qdfp/spxxFmxx', $params);
    }
    
    /**
     * 查询商品分类
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryCategoryList(array $params = [])
    {
        return $this->request('/v2/invoice/qdfp/spxxFlcx', $params);
    }
    
    /**
     * 新增商品分类
     * 
     * @param array $params 分类参数
     * @return array
     * @throws QixiangyunException
     */
    public function addCategory(array $params)
    {
        $this->validateParams($params, ['categoryName']);
        
        return $this->request('/v2/invoice/qdfp/spxxFladd', $params);
    }
    
    /**
     * 删除商品分类
     * 
     * @param array $params 删除参数
     * @return array
     * @throws QixiangyunException
     */
    public function deleteCategory(array $params)
    {
        $this->validateParams($params, ['categoryId']);
        
        return $this->request('/v2/invoice/qdfp/spxxFldel', $params);
    }
    
    /**
     * 修改商品分类
     * 
     * @param array $params 修改参数
     * @return array
     * @throws QixiangyunException
     */
    public function updateCategory(array $params)
    {
        $this->validateParams($params, ['categoryId', 'categoryName']);
        
        return $this->request('/v2/invoice/qdfp/spxxFlrename', $params);
    }
    
    /**
     * 查询商品
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryProductList(array $params = [])
    {
        return $this->request('/v2/invoice/qdfp/spxxCx', $params);
    }
    
    /**
     * 新增商品
     * 
     * @param array $params 商品参数
     * @return array
     * @throws QixiangyunException
     */
    public function addProduct(array $params)
    {
        $this->validateParams($params, ['productName', 'taxCode']);
        
        return $this->request('/v2/invoice/qdfp/spxxAdd', $params);
    }
    
    /**
     * 编辑商品
     * 
     * @param array $params 编辑参数
     * @return array
     * @throws QixiangyunException
     */
    public function updateProduct(array $params)
    {
        $this->validateParams($params, ['productId']);
        
        return $this->request('/v2/invoice/qdfp/spxxUpdate', $params);
    }
    
    /**
     * 删除商品
     * 
     * @param array $params 删除参数
     * @return array
     * @throws QixiangyunException
     */
    public function deleteProduct(array $params)
    {
        $this->validateParams($params, ['productId']);
        
        return $this->request('/v2/invoice/qdfp/spxxDel', $params);
    }
}
