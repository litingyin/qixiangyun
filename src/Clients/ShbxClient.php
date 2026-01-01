<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 社保客户端
 * 处理社保相关业务
 */
class ShbxClient extends BaseClient
{
    protected $clientName = 'shbx';
    
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
     * 企业登记和查询
     * 
     * @param array $params 登记参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getCompanyRegisterInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/getCompanyRegisterInfo', $params);
    }
    
    /**
     * 账户密码上传校验
     * 
     * @param array $params 校验参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function checkAccountPassword(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'username', 'password']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/checkAccountPassword', $params);
    }
    
    /**
     * 年度缴费工资查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryAnnualPaymentSalary(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryAnnualPaymentSalary', $params);
    }
    
    /**
     * 年度缴费工资调整
     * 
     * @param array $params 调整参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function adjustAnnualPaymentSalary(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'salaryData']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/adjustAnnualPaymentSalary', $params);
    }
    
    /**
     * 月度缴费工资查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryMonthlyPaymentSalary(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'yearMonth']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryMonthlyPaymentSalary', $params);
    }
    
    /**
     * 月度缴费工资调整
     * 
     * @param array $params 调整参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function adjustMonthlyPaymentSalary(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'yearMonth', 'salaryData']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/adjustMonthlyPaymentSalary', $params);
    }
    
    /**
     * 缴费工资申报记录查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryPaymentSalaryDeclarationRecord(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryPaymentSalaryDeclarationRecord', $params);
    }
    
    /**
     * 日常待申报信息查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryDailyUnDeclare(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryDailyUnDeclare', $params);
    }
    
    /**
     * 日常申报提交
     * 
     * @param array $params 申报参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function dailyDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'declareData']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/dailyDeclaration', $params);
    }
    
    /**
     * 日常申报提交反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getDailyDeclarationFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/dailyDeclarationFk', $params);
    }
    
    /**
     * 特殊缴款待申报信息查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function querySpecialPayUnDeclare(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/querySpecialPayUnDeclare', $params);
    }
    
    /**
     * 特殊缴款申报提交
     * 
     * @param array $params 申报参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function specialPayDeclaration(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'declareData']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/specPayDeclaration', $params);
    }
    
    /**
     * 特殊缴款申报提交反馈
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getSpecialPayDeclarationFeedback(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/specPayDeclarationFk', $params);
    }
    
    /**
     * 社保申报记录查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryDeclareRecord(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryDeclareRecord', $params);
    }
    
    /**
     * 社保申报作废
     * 
     * @param array $params 作废参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function cancelDeclare(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'declareId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/cancelDeclare', $params);
    }
    
    /**
     * 三方协议查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function thirdQuery(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/thirdQuery', $params);
    }
    
    /**
     * 获取欠费信息
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getQfxx(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/getQfxx', $params);
    }
    
    /**
     * 三方协议缴款
     * 
     * @param array $params 缴款参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function thirdPay(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'payData']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/thirdPay', $params);
    }
    
    /**
     * 银行端缴款凭证打印
     * 
     * @param array $params 打印参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function printBankPaymentVoucher(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'payId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/printBankPaymentVoucher', $params);
    }
    
    /**
     * 银行端缴款凭证作废
     * 
     * @param array $params 作废参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function cancelBankPaymentVoucher(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'voucherId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/cancelBankPaymentVoucher', $params);
    }
    
    /**
     * 缴费记录查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryPayRecord(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryPayRecord', $params);
    }
    
    /**
     * 税收完税证明打印
     * 
     * @param array $params 打印参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function printTaxProof(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'proofType', 'period']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/printTaxProof', $params);
    }
    
    /**
     * 单位缴费记录打印
     * 
     * @param array $params 打印参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function printPayRecord(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'period']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/printPayRecord', $params);
    }
    
    /**
     * 职工缴费记录打印
     * 
     * @param array $params 打印参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function printEmployeePaymentRecord(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'employeeIds', 'period']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/printEmployeePaymentRecord', $params);
    }
    
    /**
     * 社保费申报记录人员明细查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryPayRecordRymx(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'declareId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryPayRecordRymx', $params);
    }
    
    /**
     * 单位参保信息查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryUnitInsuranceInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryUnitInsuranceInfo', $params);
    }
    
    /**
     * 社保费申报明细查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function querySocialSecurityFeeDeclarationDetail(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'declareId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/querySocialSecurityFeeDeclarationDetail', $params);
    }
    
    /**
     * 社保费应缴信息查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function querySocialSecurityFeePayableInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId', 'period']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/querySocialSecurityFeePayableInfo', $params);
    }
    
    /**
     * 职工参保信息查询
     * 
     * @param array $params 查询参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function queryEmployeeInsuranceInfo(array $params)
    {
        $this->validateParams($params, ['aggOrgId']);
        
        return $this->requestBaseResponse('/v2/shbx/declare/queryEmployeeInsuranceInfo', $params);
    }
}
