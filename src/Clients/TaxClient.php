<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\TaxResponse;

class TaxClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'TaxClient';
    }
    
    /**
     * 批量设置会计准则制度
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function batchAccountingStandard(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/batchAccountingStandard', $params);
    }
    
    /**
     * 查询漏报检查任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function queryTaskTaxInfo(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/queryTaskTaxInfo', $params);
    }
    
    /**
     * 发起获取申报条目任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadTaxItemTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadTaxItemTask', $params);
    }
    
    /**
     * 上传各税种申报表数据
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function writeTaxData(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/writeTaxData', $params);
    }
    
    /**
     * 上传各税种申报表EXCEL数据
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function writeTaxExcelData(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/writeTaxExcelData', $params);
    }
    
    /**
     * 查询下载PDF任务结果
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function queryTaskInfo(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/queryTaskInfo', $params);
    }
    
    /**
     * 上传财报数据
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function writeFiData(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/writeFiData', $params);
    }
    
    /**
     * 发起申报任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadDeclareTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadDeclareTask', $params);
    }
    
    /**
     * 发起更正申报任务接口
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function writeTaxDataWithGzDeclare(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/writeTaxDataWithGzDeclare', $params);
    }
    
    /**
     * 发起简易申报任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadSimplifiedDeclareTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadSimplifiedDeclareTask', $params);
    }
    
    /**
     * 发起作废申报任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadTaxSbCancel(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadTaxSbCancel', $params);
    }
    
    /**
     * 查询作废申报任务结果
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function queryTaxSbCancel(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/queryTaxSbCancel', $params);
    }
    
    /**
     * 发起税款缴纳任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadPaymentTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadPaymentTask', $params);
    }
    
    /**
     * 发起申报信息查询任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadDeclareInfoTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadDeclareInfoTask', $params);
    }
    
    /**
     * 发起漏报检查任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadTaxCheckTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadTaxCheckTask', $params);
    }
    
    /**
     * 发起获取我的待办
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadTaxMyTodo(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadTaxMyTodo', $params);
    }
    
    /**
     * 发起获取我的提醒
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadTaxMyRemind(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadTaxMyRemind', $params);
    }
    
    /**
     * 发起下载完税证明任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadWszmTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadWszmTask', $params);
    }
    
    /**
     * 发起下载当期PDF任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadPdfTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadPdfTask', $params);
    }
    
    /**
     * 发起下载往期PDF任务
     *
     * @param array $params 参数
     * @return TaxResponse
     */
    public function loadWqPdfTask(array $params): TaxResponse
    {
        return $this->requestTaxResponse('v2/tax/qys/loadWqPdfTask', $params);
    }
}