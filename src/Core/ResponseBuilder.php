<?php

namespace QixiangyunSDK\Core;

use QixiangyunSDK\Core\Types\AccountResponse;
use QixiangyunSDK\Core\Types\InvoiceResponse;
use QixiangyunSDK\Core\Types\OrgResponse;
use QixiangyunSDK\Core\Types\ProductResponse;
use QixiangyunSDK\Core\Types\TaxResponse;
use QixiangyunSDK\Core\Types\BsryglResponse;
use QixiangyunSDK\Core\Types\CktsResponse;
use QixiangyunSDK\Core\Types\CollectResponse;
use QixiangyunSDK\Core\Types\CustomsResponse;
use QixiangyunSDK\Core\Types\FpruzResponse;
use QixiangyunSDK\Core\Types\GjResponse;
use QixiangyunSDK\Core\Types\KhxxResponse;
use QixiangyunSDK\Core\Types\LegislationResponse;
use QixiangyunSDK\Core\Types\LoginResponse;
use QixiangyunSDK\Core\Types\MessageResponse;
use QixiangyunSDK\Core\Types\PhoneResponse;
use QixiangyunSDK\Core\Types\QdfpResponse;
use QixiangyunSDK\Core\Types\BaseResponse;

/**
 * 响应构建器
 * 用于构建类型化的响应对象
 */
class ResponseBuilder
{
    /**
     * 构建发票响应
     *
     * @param array $data 原始数据
     * @return InvoiceResponse
     */
    public static function invoice(array $data): InvoiceResponse
    {
        return new InvoiceResponse($data);
    }
    
    /**
     * 构建企业信息响应
     *
     * @param array $data 原始数据
     * @return OrgResponse
     */
    public static function org(array $data): OrgResponse
    {
        return new OrgResponse($data);
    }
    
    /**
     * 构建税务申报响应
     *
     * @param array $data 原始数据
     * @return TaxResponse
     */
    public static function tax(array $data): TaxResponse
    {
        return new TaxResponse($data);
    }
    
    /**
     * 构建产品管理响应
     *
     * @param array $data 原始数据
     * @return ProductResponse
     */
    public static function product(array $data): ProductResponse
    {
        return new ProductResponse($data);
    }
    
    /**
     * 构建账户管理响应
     *
     * @param array $data 原始数据
     * @return AccountResponse
     */
    public static function account(array $data): AccountResponse
    {
        return new AccountResponse($data);
    }
    
    /**
     * 构建通用响应
     *
     * @param array $data 原始数据
     * @return Response
     */
    public static function general(array $data): Response
    {
        return new Response($data);
    }
    
    /**
     * 构建办税人员管理响应
     *
     * @param array $data 原始数据
     * @return BsryglResponse
     */
    public static function bsrygl(array $data): BsryglResponse
    {
        return new BsryglResponse($data);
    }
    
    /**
     * 构建出口退税响应
     *
     * @param array $data 原始数据
     * @return CktsResponse
     */
    public static function ckts(array $data): CktsResponse
    {
        return new CktsResponse($data);
    }
    
    /**
     * 构建企业采集响应
     *
     * @param array $data 原始数据
     * @return CollectResponse
     */
    public static function collect(array $data): CollectResponse
    {
        return new CollectResponse($data);
    }
    
    /**
     * 构建海关响应
     *
     * @param array $data 原始数据
     * @return CustomsResponse
     */
    public static function customs(array $data): CustomsResponse
    {
        return new CustomsResponse($data);
    }
    
    /**
     * 构建发票入账响应
     *
     * @param array $data 原始数据
     * @return FpruzResponse
     */
    public static function fpruz(array $data): FpruzResponse
    {
        return new FpruzResponse($data);
    }
    
    /**
     * 构建发票归集响应
     *
     * @param array $data 原始数据
     * @return GjResponse
     */
    public static function gj(array $data): GjResponse
    {
        return new GjResponse($data);
    }
    
    /**
     * 构建基础响应
     *
     * @param array $data 原始数据
     * @return BaseResponse
     */
    public static function base(array $data): BaseResponse
    {
        return new BaseResponse($data);
    }
    
    /**
     * 构建客户信息响应
     *
     * @param array $data 原始数据
     * @return KhxxResponse
     */
    public static function khxx(array $data): KhxxResponse
    {
        return new KhxxResponse($data);
    }
    
    /**
     * 构建政策法规响应
     *
     * @param array $data 原始数据
     * @return LegislationResponse
     */
    public static function legislation(array $data): LegislationResponse
    {
        return new LegislationResponse($data);
    }
    
    /**
     * 构建登录响应
     *
     * @param array $data 原始数据
     * @return LoginResponse
     */
    public static function login(array $data): LoginResponse
    {
        return new LoginResponse($data);
    }
    
    /**
     * 构建消息响应
     *
     * @param array $data 原始数据
     * @return MessageResponse
     */
    public static function message(array $data): MessageResponse
    {
        return new MessageResponse($data);
    }
    
    /**
     * 构建办税小号响应
     *
     * @param array $data 原始数据
     * @return PhoneResponse
     */
    public static function phone(array $data): PhoneResponse
    {
        return new PhoneResponse($data);
    }
    
    /**
     * 构建前台发票响应
     *
     * @param array $data 原始数据
     * @return QdfpResponse
     */
    public static function qdfp(array $data): QdfpResponse
    {
        return new QdfpResponse($data);
    }
}