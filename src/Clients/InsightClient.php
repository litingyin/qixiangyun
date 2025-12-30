<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 企业洞察客户端
 * 处理企业信息洞察相关业务
 */
class InsightClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'insight';
    }
    
    /**
     * 验证参数
     *
     * @param array $params 参数数组
     * @param array $required 必需参数数组
     * @throws QixiangyunException
     */
    protected function validateParams(array $params, array $required): void
    {
        foreach ($required as $param) {
            if (!isset($params[$param])) {
                throw new QixiangyunException("参数 {$param} 是必需的");
            }
        }
    }
    
    /**
     * 新增企业信息
     * 
     * @param array $params 企业信息参数
     * @return array
     * @throws QixiangyunException
     */
    public function newEnterprise(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/newEnterprise', $params);
    }
    
    /**
     * 企业联系人信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function contactInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/contactInfo', $params);
    }
    
    /**
     * 工商基本信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function info(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/info', $params);
    }
    
    /**
     * 企业联系信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function companyContactInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/companyContactInfo', $params);
    }
    
    /**
     * 对外投资
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function investmentAbroad(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/investmentAbroad', $params);
    }
    
    /**
     * 税务重大违法
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function taxBigIllegal(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/taxBigIllegal', $params);
    }
    
    /**
     * 资质证书信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function certificateInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/certificateInfo', $params);
    }
    
    /**
     * 限制高消费信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function limitHighConsumerInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/limitHighConsumerInfo', $params);
    }
    
    /**
     * 限制高消费关联企业
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function limitHighConsumerRelationEn(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/limitHighConsumerRelationEn', $params);
    }
    
    /**
     * 裁判文书
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function judgmentDoc(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/judgmentDoc', $params);
    }
    
    /**
     * 欠税公告
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function oweTaxInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/oweTaxInfo', $params);
    }
    
    /**
     * 税务非正常户
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function taxUnNormalInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/taxUnNormalInfo', $params);
    }
    
    /**
     * 行政处罚信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function administrationPenalty(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/administrationPenalty', $params);
    }
    
    /**
     * 行政许可信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function administractiveLicense(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/administrativeLicense', $params);
    }
    
    /**
     * 列入经营异常名录信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function exceptionList(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/exceptionList', $params);
    }
    
    /**
     * 列入严重违法失信企业名单
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function seriousIllegalBlackInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/seriousIllegalBlackInfo', $params);
    }
    
    /**
     * 商标信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function trademarkInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/trademarkInfo', $params);
    }
    
    /**
     * 专利信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function patentInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/patentInfo', $params);
    }
    
    /**
     * 专利关系信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function patentRelationInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/patentRelationInfo', $params);
    }
    
    /**
     * 专利法律状态信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function patentLawStatus(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/patentLawStatus', $params);
    }
    
    /**
     * A类纳税人信息查询
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function taxpayerLevelA(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/taxpayerLevelA', $params);
    }
    
    /**
     * 股东出资信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function shareholderInvest(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/shareholderInvest', $params);
    }
    
    /**
     * 分支机构信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function branchInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/branchInfo', $params);
    }
    
    /**
     * 失信信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function dishonestyInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/dishonestyInfo', $params);
    }
    
    /**
     * 失信执行信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function executeInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/executeInfo', $params);
    }
    
    /**
     * 失信被执行对象
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function enforceObj(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/enforceObj', $params);
    }
    
    /**
     * 立案公告信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function caseInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/caseInfo', $params);
    }
    
    /**
     * 裁判文书相关企业
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function judgementDocRelation(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/judgementDocRelation', $params);
    }
    
    /**
     * 域名备案
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function websiteInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/websiteInfo', $params);
    }
    
    /**
     * 软件著作权信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function softwareCopyright(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/softwareCopyright', $params);
    }
    
    /**
     * 高管关联企业信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function orgManagerAssociateEnt(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/orgManagerAssociateEnt', $params);
    }
    
    /**
     * 招投标信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function bidInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/bidInfo', $params);
    }
    
    /**
     * 企业年报
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function annualRpt(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/annualRpt', $params);
    }
    
    /**
     * 企业变更信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function alterInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/alterInfo', $params);
    }
    
    /**
     * 股权出质信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function equityPledgeInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/equityPledgeInfo', $params);
    }
    
    /**
     * 主要人员信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function keyPersonnelInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/keyPersonnelInfo', $params);
    }
    
    /**
     * 开庭公告信息
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function courtAnnouncementInfo(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/courtAnnouncementInfo', $params);
    }
    
    /**
     * 司法股权冻结
     * 
     * @param array $params 查询参数
     * @return array
     * @throws QixiangyunException
     */
    public function judicialEquityFreeze(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->request('/v2/insight/judicialEquityFreeze', $params);
    }
}
