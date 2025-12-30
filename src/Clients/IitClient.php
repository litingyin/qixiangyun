<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;

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
     * @return array
     */
    public function getCompanyRegisterInfo(array $params): array
    {
        return $this->httpClient->post('v2/iit/declare/getCompanyRegisterInfo', $params);
    }
    
    /**
     * 账号信息上传并校验（申报密码校验）
     *
     * @param array $params 参数
     * @return array
     */
    public function checkPassword(array $params): array
    {
        return $this->httpClient->post('v2/iit/check/checkPassword', $params);
    }
    
    /**
     * 投资者信息报送
     *
     * @param array $params 参数
     * @return array
     */
    public function declareEmployeeInfo(array $params): array
    {
        return $this->httpClient->post('v2/iit/declare/declareEmployeeInfo', $params);
    }
    
    /**
     * 投资者信息报送反馈
     *
     * @param array $params 参数
     * @return array
     */
    public function getEmployeeInfoFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/declare/getEmployeeInfoFeedback', $params);
    }
    
    /**
     * 作废人员信息
     *
     * @param array $params 参数
     * @return array
     */
    public function batchInvalidSubmission(array $params): array
    {
        return $this->httpClient->post('v2/iit/declare/batchInvalidSubmission', $params);
    }
    
    /**
     * 企业人员列表查询
     *
     * @param array $params 参数
     * @return array
     */
    public function getCompanyEmployee(array $params): array
    {
        return $this->httpClient->post('v2/iit/data/getCompanyEmployee', $params);
    }
    
    /**
     * 异步算税
     *
     * @param array $params 参数
     * @return array
     */
    public function calculateASynIndividualIncomeTax(array $params): array
    {
        return $this->httpClient->post('v2/iit/calculateTax/calculateASynIndividualIncomeTax', $params);
    }
    
    /**
     * 异步算税反馈
     *
     * @param array $params 参数
     * @return array
     */
    public function getASynIndividualIncomeTaxFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/calculateTax/getASynIndividualIncomeTaxFeedback', $params);
    }
    
    /**
     * 申报数据报送
     *
     * @param array $params 参数
     * @return array
     */
    public function send(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/send', $params);
    }
    
    /**
     * 申报数据报送反馈
     *
     * @param array $params 参数
     * @return array
     */
    public function getFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/getFeedback', $params);
    }
    
    /**
     * 申报内置算税结果查询
     *
     * @param array $params 参数
     * @return array
     */
    public function getDeclareTaxResultFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/getDeclareTaxResultFeedback', $params);
    }
    
    /**
     * 申报作废
     *
     * @param array $params 参数
     * @return array
     */
    public function cancel(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/cancel', $params);
    }
    
    /**
     * 申报作废反馈
     *
     * @param array $params 参数
     * @return array
     */
    public function getCancelFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/getCancelFeedback', $params);
    }
    
    /**
     * 申报状态查询
     *
     * @param array $params 参数
     * @return array
     */
    public function queryDeclarationRecord(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/queryDeclarationRecord', $params);
    }
    
    /**
     * 申报更正
     *
     * @param array $params 参数
     * @return array
     */
    public function correct(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/correct', $params);
    }
    
    /**
     * 撤销更正申报
     *
     * @param array $params 参数
     * @return array
     */
    public function cancelCorrect(array $params): array
    {
        return $this->httpClient->post('v2/iit/report/cancelCorrect', $params);
    }
    
    /**
     * 发送扣缴确认申报申请
     *
     * @param array $params 参数
     * @return array
     */
    public function sendWithholdingConfirm(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/sendWithholdingConfirm', $params);
    }
    
    /**
     * 获取三方信息
     *
     * @param array $params 参数
     * @return array
     */
    public function queryAgreement(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/queryAgreement', $params);
    }
    
    /**
     * 三方协议缴款
     *
     * @param array $params 参数
     * @return array
     */
    public function declareWithholding(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/declareWithholding', $params);
    }
    
    /**
     * 三方协议缴款反馈
     *
     * @param array $params 参数
     * @return array
     */
    public function getWithholdingFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/getWithholdingFeedback', $params);
    }
    
    /**
     * 银联缴款
     *
     * @param array $params 参数
     * @return array
     */
    public function getUnionPayUrl(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/getUnionPayUrl', $params);
    }
    
    /**
     * 缴款状态查询
     *
     * @param array $params 参数
     * @return array
     */
    public function getSyncWithholdingFeedback(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/getSyncWithholdingFeedback', $params);
    }
    
    /**
     * 打印缴款凭证
     *
     * @param array $params 参数
     * @return array
     */
    public function withholdingVoucher(array $params): array
    {
        return $this->httpClient->post('v2/iit/payment/withholdingVoucher', $params);
    }
}