<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\CktsResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 出口退税客户端
 * 处理出口退税相关业务
 */
class CktsClient extends BaseClient
{
    protected $clientName = 'ckts';
    
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
     * 出口退税申报自检任务发起
     * 
     * @param array $params 自检参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function selfCheck(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod', 'taxData']);
        
        return $this->requestCktsResponse('/v2/ckts/selfCheck', $params);
    }
    
    /**
     * 出口退税申报自检任务结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getSelfCheckResult(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getSelfCheckResult', $params);
    }
    
    /**
     * 出口退税自检反馈查询
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function loadSelfCheckFeedback(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/loadSelfCheckFeedback', $params);
    }
    
    /**
     * 出口退税自检反馈查询结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getSelfCheckFeedback(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getSelfCheckFeedback', $params);
    }
    
    /**
     * 出口退税审核进度查询
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function loadReviewProgress(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->requestCktsResponse('/v2/ckts/loadReviewProgress', $params);
    }
    
    /**
     * 出口退税审核进度查询结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getReviewProgress(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getReviewProgress', $params);
    }
    
    /**
     * 出口退税申报确认提交
     * 
     * @param array $params 提交参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function loadDeclareConfirmation(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod', 'taxData']);
        
        return $this->requestCktsResponse('/v2/ckts/loadDeclareConfirmation', $params);
    }
    
    /**
     * 出口退税查询申报确认提交结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getDeclareConfirmationResult(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getDeclareConfirmationResult', $params);
    }
    
    /**
     * 出口退税获取审核任务清单发起
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function loadAuditTaskList(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->requestCktsResponse('/v2/ckts/loadAuditTaskList', $params);
    }
    
    /**
     * 出口退税获取审核任务清单结果查询
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getAuditTaskListResult(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getAuditTaskListResult', $params);
    }
    
    /**
     * 出口退税申报表下载
     * 
     * @param array $params 下载参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function downloadSbForm(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->requestCktsResponse('/v2/ckts/downloadSbForm', $params);
    }
    
    /**
     * 出口退税申报表下载结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getDownloadSbForm(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getDownloadSbForm', $params);
    }
    
    /**
     * 出口退税附列资料上传
     * 
     * @param array $params 上传参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function uploadAttachedInformation(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod', 'fileData']);
        
        return $this->requestCktsResponse('/v2/ckts/attachedInformationUpload', $params);
    }
    
    /**
     * 出口退税附列资料上传结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getAttachedInformationUpload(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getAttachedInformationUpload', $params);
    }
    
    /**
     * 出口退税申报作废
     * 
     * @param array $params 作废参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function cancelSbForm(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod', 'declareId']);
        
        return $this->requestCktsResponse('/v2/ckts/cancelSbForm', $params);
    }
    
    /**
     * 出口退税申报作废结果
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function getCancelSbForm(array $params): CktsResponse
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestCktsResponse('/v2/ckts/getCancelSbForm', $params);
    }
    
    /**
     * 出口退税文库查询
     * 
     * @param array $params 查询参数
     * @return CktsResponse
     * @throws QixiangyunException
     */
    public function syncRefundTaxLibraryQuery(array $params): CktsResponse
    {
        $this->validateParams($params, ['orgId', 'taxPeriod']);
        
        return $this->requestCktsResponse('/v2/ckts/syncRefundTaxLibraryQuery', $params);
    }
}
