<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 生产经营所得客户端
 * 处理生产经营所得相关业务
 */
class ScjyClient extends BaseClient
{
    protected $clientName = 'scjy';
    
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
     * 投资者列表查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getInvestorInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/scjy/data/getInvestorInfo', $params);
    }
    
    /**
     * 获取企业及投资者信息（生产经营）
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getEnterpriseAndInvestorInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/scjy/basic/getEnterpriseAndInvestorInfo', $params);
    }
    
    /**
     * 获取收入费用测算情况及预缴信息
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getRevenueExpenseAndPrepaymentInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/calculateTax/getRevenueExpenseAndPrepaymentInfo', $params);
    }
    
    /**
     * 异步算税服务
     * 
     * @param array $params 算税参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function calculateASynIndividualIncomeTax(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/calculateTax/calculateASynIndividualIncomeTax', $params);
    }
    
    /**
     * 查询算税反馈结果
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getASynIndividualIncomeTaxFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/calculateTax/getASynIndividualIncomeTaxFeedback', $params);
    }
    
    /**
     * 申报数据报送
     * 
     * @param array $params 申报参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function sendDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/send', $params);
    }
    
    /**
     * 申报数据报送反馈结果
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getDeclarationFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/report/getFeedback', $params);
    }
    
    /**
     * 查询内置算税反馈结果
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getDeclareTaxResultFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/report/getDeclareTaxResultFeedback', $params);
    }
    
    /**
     * 企业申报数据明细查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getCompanyIncomes(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/getCompanyIncomes', $params);
    }
    
    /**
     * 辅助申报-申报状态查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function checkDeclarationStatus(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/checkStatus', $params);
    }
    
    /**
     * 申报作废
     * 
     * @param array $params 作废参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function abandonedDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/abandoned', $params);
    }
    
    /**
     * 申报作废反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getAbandonedFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/report/abandonedFeedback', $params);
    }
    
    /**
     * 更正申报
     * 
     * @param array $params 更正参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function correctDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/correct', $params);
    }
    
    /**
     * 撤销更正申报
     * 
     * @param array $params 撤销参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function cancelCorrectDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/report/cancelCorrect', $params);
    }
    
    /**
     * 获取三方信息
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getThirdInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/thirdInfo', $params);
    }
    
    /**
     * 获取三方信息反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getThirdInfoFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/thirdInfo/feedback', $params);
    }
    
    /**
     * 三方协议缴款
     * 
     * @param array $params 缴款参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function thirdAgreementPayment(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/thirdAgreementPayment', $params);
    }
    
    /**
     * 三方协议缴款反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getThirdAgreementPaymentFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/thirdAgreementPayment/feedback', $params);
    }
    
    /**
     * 银联缴款
     * 
     * @param array $params 缴款参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getUnionPayUrl(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/getUnionPayUrl', $params);
    }
    
    /**
     * 扫码缴款
     * 
     * @param array $params 缴款参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function scanPayment(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/scanPay', $params);
    }
    
    /**
     * 缴款状态查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function checkPaymentStatus(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/checkStatus', $params);
    }
    
    /**
     * 打印缴款凭证（生产经营）
     * 
     * @param array $params 打印参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function printWithholdingVoucher(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/withholdingVoucher', $params);
    }
    
    /**
     * 打印缴款凭证反馈（生产经营）
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getWithholdingVoucherFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/getWithholdingVoucherFeedback', $params);
    }
    
    /**
     * 打印缴款凭证的缴款结果查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function checkPaymentReceipt(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/checkReceipt', $params);
    }
    
    /**
     * 缴款凭证作废（生产经营）
     * 
     * @param array $params 作废参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function cancelWithholdingVoucher(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/cancelWithholdingVoucher', $params);
    }
    
    /**
     * 完税证明开具（生产经营）
     * 
     * @param array $params 开具参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getWithheldVoucher(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'investorId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/getWithheldVoucher', $params);
    }
    
    /**
     * 生产经营-欠费查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryArrearage(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/queryArrearage', $params);
    }
    
    /**
     * 生产经营-欠费查询反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getArrearageQueryFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/getArrearageQueryFeedback', $params);
    }
    
    /**
     * 生产经营-漏报漏缴检查
     * 
     * @param array $params 检查参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function lbljCheck(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'taxPeriod']);
        
        return $this->requestBaseResponse('/v2/scjy/check/lbljCheck', $params);
    }
    
    /**
     * 生产经营-缴税记录查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryTaxPayment(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/scjy/payment/queryTaxPayment', $params);
    }
}
