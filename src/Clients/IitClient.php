<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;

class IitClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'IitClient';
    }
    
    /**
     * 企业注册
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getCompanyRegisterInfo(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/declare/getCompanyRegisterInfo', $params);
    }
    
    /**
     * 账号信息上传并校验（申报密码校验）
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function checkPassword(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/check/checkPassword', $params);
    }
    
    /**
     * 投资者信息报送
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function declareEmployeeInfo(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/declare/declareEmployeeInfo', $params);
    }
    
    /**
     * 投资者信息报送反馈
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getEmployeeInfoFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/declare/getEmployeeInfoFeedback', $params);
    }
    
    /**
     * 作废人员信息
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function batchInvalidSubmission(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/declare/batchInvalidSubmission', $params);
    }
    
    /**
     * 企业人员列表查询
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getCompanyEmployee(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/data/getCompanyEmployee', $params);
    }
    
    /**
     * 异步算税
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function calculateASynIndividualIncomeTax(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/calculateTax/calculateASynIndividualIncomeTax', $params);
    }
    
    /**
     * 异步算税反馈
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getASynIndividualIncomeTaxFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/calculateTax/getASynIndividualIncomeTaxFeedback', $params);
    }
    
    /**
     * 申报数据报送
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function send(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/send', $params);
    }
    
    /**
     * 申报数据报送反馈
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/getFeedback', $params);
    }
    
    /**
     * 申报内置算税结果查询
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getDeclareTaxResultFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/getDeclareTaxResultFeedback', $params);
    }
    
    /**
     * 申报作废
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function cancel(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/cancel', $params);
    }
    
    /**
     * 申报作废反馈
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getCancelFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/getCancelFeedback', $params);
    }
    
    /**
     * 申报状态查询
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function queryDeclarationRecord(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/queryDeclarationRecord', $params);
    }
    
    /**
     * 申报更正
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function correct(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/correct', $params);
    }
    
    /**
     * 撤销更正申报
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function cancelCorrect(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/report/cancelCorrect', $params);
    }
    
    /**
     * 发送扣缴确认申报申请
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function sendWithholdingConfirm(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/sendWithholdingConfirm', $params);
    }
    
    /**
     * 获取三方信息
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function queryAgreement(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/queryAgreement', $params);
    }
    
    /**
     * 三方协议缴款
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function declareWithholding(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/declareWithholding', $params);
    }
    
    /**
     * 三方协议缴款反馈
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getWithholdingFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/getWithholdingFeedback', $params);
    }
    
    /**
     * 银联缴款
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getUnionPayUrl(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/getUnionPayUrl', $params);
    }
    
    /**
     * 缴款状态查询
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function getSyncWithholdingFeedback(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/getSyncWithholdingFeedback', $params);
    }
    
    /**
     * 打印缴款凭证
     *
     * @param array $params 参数
     * @return BaseResponse
     */
    public function withholdingVoucher(array $params): BaseResponse
    {
        return $this->requestBaseResponse('v2/iit/payment/withholdingVoucher', $params);
    }
}