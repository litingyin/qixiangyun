<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\ProductResponse;
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
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function purchase(array $params): ProductResponse
    {
        $this->validateParams($params, ['aggOrgId', 'productId', 'productType']);
        
        return $this->requestProductResponse('/v2/public/org/productPurchase', $params);
    }
    
    /**
     * 订购修改
     * 
     * @param array $params 修改参数
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function modify(array $params): ProductResponse
    {
        $this->validateParams($params, ['aggOrgId', 'productId']);
        
        return $this->requestProductResponse('/v2/public/org/productPurchaseModify', $params);
    }
    
    /**
     * 订购取消
     * 
     * @param array $params 取消参数
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function cancel(array $params): ProductResponse
    {
        $this->validateParams($params, ['aggOrgId', 'productId']);
        
        return $this->requestProductResponse('/v2/public/org/productCancel', $params);
    }
    
    /**
     * 订购查询
     * 
     * @param array $params 查询参数
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function list(array $params): ProductResponse
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestProductResponse('/v2/public/org/productList', $params);
    }
    
    /**
     * 产品列表
     * 
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function productList(): ProductResponse
    {
        return $this->requestProductResponse('/v2/public/product/list', []);
    }
    
    /**
     * 获取产品详情
     * 
     * @param string $productId 产品ID
     * @return ProductResponse
     * @throws QixiangyunException
     */
    public function productDetail($productId): ProductResponse
    {
        return $this->requestProductResponse('/v2/public/product/detail', ['productId' => $productId]);
    }
}
