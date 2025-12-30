<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 企业税种客户端
 * 处理企业税种申报相关业务
 */
class QysClient extends BaseClient
{
    protected $clientName = 'qys';
    
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
     * 批量设置会计准则制度
     * 
     * @param array $params 设置参数
     * @return array
     * @throws QixiangyunException
     */
    public function batchAccountingStandard(array $params)
    {
        $this->validateParams($params, ['orgIds', 'accountingStandard']);
        
        return $this->request('/v2/tax/qys/batchAccountingStandard', $params);
    }
    
    /**
     * 查询漏报检查任务
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaskTaxInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/tax/qys/queryTaskTaxInfo', $params);
    }
    
    /**
     * 发起获取申报条目任务
     * 
     * @param array $params 任务参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxItemTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxItemTask', $params);
    }
    
    /**
     * 上传各税种申报表数据
     * 
     * @param array $params 申报参数
     * @return array
     * @throws QixiangyunException
     */
    public function writeTaxData(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod', 'taxData']);
        
        return $this->request('/v2/tax/qys/writeTaxData', $params);
    }
    
    /**
     * 上传各税种申报表EXCEL数据
     * 
     * @param array $params 申报参数
     * @return array
     * @throws QixiangyunException
     */
    public function writeTaxExcelData(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod', 'excelData']);
        
        return $this->request('/v2/tax/qys/writeTaxExcelData', $params);
    }
    
    /**
     * 查询下载PDF任务结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaskInfo(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryTaskInfo', $params);
    }
    
    /**
     * 上传财报数据
     * 
     * @param array $params 财报参数
     * @return array
     * @throws QixiangyunException
     */
    public function writeFiData(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxPeriod', 'fiData']);
        
        return $this->request('/v2/tax/qys/writeFiData', $params);
    }
    
    /**
     * 发起查询合同接口任务
     * 
     * @param array $params 任务参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryContract(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/queryContract', $params);
    }
    
    /**
     * 查询合同任务结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryContractTaskInfo(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryContractTaskInfo', $params);
    }
    
    /**
     * 发起获取初始化数据任务
     * 
     * @param array $params 任务参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadInitDataTask(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/tax/qys/loadInitDataTask', $params);
    }
    
    /**
     * 初始化数据查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function getInitData(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/getInitData', $params);
    }
    
    /**
     * 未开票收入算税
     * 
     * @param array $params 算税参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxUnbilledCalculate(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxUnbilledCalculate', $params);
    }
    
    /**
     * 查询未开票收入算税任务
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxUnbilledCalculate(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryTaxUnbilledCalculate', $params);
    }
    
    /**
     * 发起申报任务
     * 
     * @param array $params 申报参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadDeclareTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadDeclareTask', $params);
    }
    
    /**
     * 发起更正申报任务接口
     * 
     * @param array $params 更正参数
     * @return array
     * @throws QixiangyunException
     */
    public function writeTaxDataWithGzDeclare(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod', 'taxData']);
        
        return $this->request('/v2/tax/qys/writeTaxDataWithGzDeclare', $params);
    }
    
    /**
     * 发起简易申报任务
     * 
     * @param array $params 申报参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadSimplifiedDeclareTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadSimplifiedDeclareTask', $params);
    }
    
    /**
     * 查询简易申报任务结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function querySimplifiedDeclareTaskInfo(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/querySimplifiedDeclareTaskInfo', $params);
    }
    
    /**
     * 发起作废申报任务
     * 
     * @param array $params 作废参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxSbCancel(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxSbCancel', $params);
    }
    
    /**
     * 查询作废申报任务结果
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxSbCancel(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryTaxSbCancel', $params);
    }
    
    /**
     * 发起税款缴纳任务
     * 
     * @param array $params 缴纳参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadPaymentTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadPaymentTask', $params);
    }
    
    /**
     * 发起申报信息查询任务
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadDeclareInfoTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadDeclareInfoTask', $params);
    }
    
    /**
     * 发起漏报检查任务
     * 
     * @param array $params 检查参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxCheckTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxCheckTask', $params);
    }
    
    /**
     * 税源信息采集接口
     * 
     * @param array $params 采集参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxFundTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxFundType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxFundTask', $params);
    }
    
    /**
     * 税源信息获取接口
     * 
     * @param array $params 获取参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxFundGainTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxFundType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxFundGainTask', $params);
    }
    
    /**
     * 查询税源获取任务结果接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxFundGainInfo(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryTaxFundGainInfo', $params);
    }
    
    /**
     * 税源变更接口
     * 
     * @param array $params 变更参数
     * @return array
     * @throws QixiangyunException
     */
    public function loadTaxFundChangeTask(array $params)
    {
        $this->validateParams($params, ['orgId', 'taxFundType', 'taxPeriod']);
        
        return $this->request('/v2/tax/qys/loadTaxFundChangeTask', $params);
    }
    
    /**
     * 查询税源变更任务结果接口
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function queryTaxFundChangeTask(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->request('/v2/tax/qys/queryTaxFundChangeTask', $params);
    }
}
