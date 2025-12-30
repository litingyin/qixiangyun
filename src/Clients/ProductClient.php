<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 采购和产品管理客户端
 * 处理产品订购、修改、取消等业务
 */
class ProductClient extends BaseClient
{
    protected $clientName = 'product';
    
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
     * 订购产品
     * 
     * @param array $params 订购参数
     * @return array
     * @throws QixiangyunException
     */
    public function purchase(array $params)
    {
        $this->validateParams($params, ['orgId', 'productId', 'productType']);
        
        return $this->request('/v2/public/org/productPurchase', $params);
    }
    
    /**
     * 订购修改
     * 
     * @param array $params 修改参数
     * @return array
     * @throws QixiangyunException
     */
    public function modify(array $params)
    {
        $this->validateParams($params, ['orgId', 'productId']);
        
        return $this->request('/v2/public/org/productPurchaseModify', $params);
    }
    
    /**
     * 订购取消
     * 
     * @param array $params 取消参数
     * @return array
     * @throws QixiangyunException
     */
    public function cancel(array $params)
    {
        $this->validateParams($params, ['orgId', 'productId']);
        
        return $this->request('/v2/public/org/productCancel', $params);
    }
    
    /**
     * 订购查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function list(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/public/org/productList', $params);
    }
    
    /**
     * 产品列表
     * 
     * @return array
     * @throws QixiangyunException
     */
    public function productList()
    {
        return $this->request('/v2/public/product/list', []);
    }
    
    /**
     * 获取产品详情
     * 
     * @param string $productId 产品ID
     * @return array
     * @throws QixiangyunException
     */
    public function productDetail($productId)
    {
        return $this->request('/v2/public/product/detail', ['productId' => $productId]);
    }
}
