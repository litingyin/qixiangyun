<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 前台发票客户端
 * 处理发票开具、查询、红冲等前台业务
 */
class QdfpClient extends BaseClient
{
    protected $clientName = 'qdfp';
    
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
     * 普通票据识别
     * 
     * @param array $params 识别参数
     * @return array
     * @throws QixiangyunException
     */
    public function ocr(array $params)
    {
        $this->validateParams($params, ['imageUrl']);
        
        return $this->request('/v2/invoice/ocr/sb', $params);
    }
    
    /**
     * 企业基本信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getOrgInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/qyjbxxcx', $params);
    }
    
    /**
     * 扫脸时长查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryFaceTime(array $params)
    {
        return $this->request('/v2/invoice/qdfp/sxlbCx', $params);
    }
    
    /**
     * 扫脸时长设置
     * 
     * @param array $params 设置参数
     * @return array
     * @throws QixiangyunException
     */
    public function setFaceTime(array $params)
    {
        $this->validateParams($params, ['duration']);
        
        return $this->request('/v2/invoice/qdfp/smsc', $params);
    }
    
    /**
     * 获取人脸识别二维码
     * 
     * @param array $params 参数
     * @return array
     * @throws QixiangyunException
     */
    public function getFaceQrcode(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/rzewm', $params);
    }
    
    /**
     * 获取人脸识别结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getFaceResult(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/invoice/qdfp/rzztcx', $params);
    }
    
    /**
     * 查询成品油库存汇总台账
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryOilStock(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/queryKchztz', $params);
    }
    
    /**
     * 开票额度查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryQuota(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/kptjxxcx', $params);
    }
    
    /**
     * 申请红字信息表
     * 
     * @param array $params 申请参数
     * @return array
     * @throws QixiangyunException
     */
    public function applyRedInfo(array $params)
    {
        $this->validateParams($params, ['orgId', 'invoiceType', 'invoiceNo']);
        
        return $this->request('/v2/invoice/qdfp/hzqrxxSave', $params);
    }
    
    /**
     * 红字发票开具
     * 
     * @param array $params 开具参数
     * @return array
     * @throws QixiangyunException
     */
    public function createRedInvoice(array $params)
    {
        $this->validateParams($params, ['orgId', 'invoiceType']);
        
        return $this->request('/v2/invoice/qdfp/hzFpkj', $params);
    }
    
    /**
     * 确认红字信息表
     * 
     * @param array $params 确认参数
     * @return array
     * @throws QixiangyunException
     */
    public function confirmRedInfo(array $params)
    {
        $this->validateParams($params, ['redInfoId']);
        
        return $this->request('/v2/invoice/qdfp/hzqrxxConfirm', $params);
    }
    
    /**
     * 撤销红字信息表
     * 
     * @param array $params 撤销参数
     * @return array
     * @throws QixiangyunException
     */
    public function cancelRedInfo(array $params)
    {
        $this->validateParams($params, ['redInfoId']);
        
        return $this->request('/v2/invoice/qdfp/hzqrxxCancel', $params);
    }
    
    /**
     * 查询红字信息列表
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function listRedInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/hzqrxxList', $params);
    }
    
    /**
     * 查询红字信息明细
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getRedInfoDetail(array $params)
    {
        $this->validateParams($params, ['redInfoId']);
        
        return $this->request('/v2/invoice/qdfp/hzqrxxDetail', $params);
    }
    
    /**
     * 已开发票列表查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryInvoiceList(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/fpcx', $params);
    }
    
    /**
     * 已开发票明细查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryInvoiceDetail(array $params)
    {
        $this->validateParams($params, ['invoiceId']);
        
        return $this->request('/v2/invoice/qdfp/fpmx', $params);
    }
    
    /**
     * 已开发票统计查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryInvoiceStats(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/fptjcx', $params);
    }
    
    /**
     * 下载版式文件
     * 
     * @param array $params 下载参数
     * @return array
     * @throws QixiangyunException
     */
    public function downloadFileBatch(array $params)
    {
        $this->validateParams($params, ['invoiceIds']);
        
        return $this->request('/v2/invoice/qdfp/bswjxzBatch', $params);
    }
    
    /**
     * 申请发票额度调整
     * 
     * @param array $params 申请参数
     * @return array
     * @throws QixiangyunException
     */
    public function applyQuotaAdjustment(array $params)
    {
        $this->validateParams($params, ['orgId', 'quotaType', 'quotaAmount']);
        
        return $this->request('/v2/invoice/qdfp/saveSxedsqSqxx', $params);
    }
    
    /**
     * 查询申请额度列表
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryQuotaApplyList(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/invoice/qdfp/querySxedtzSqxx', $params);
    }
}
