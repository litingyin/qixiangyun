<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

/**
 * 数电文件版式下载客户端
 * 处理数电票版式文件下载相关业务
 */
class SdFileClient extends BaseClient
{
    protected $clientName = 'sdfile';
    
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
     * 发起获取数电版式任务
     * 
     * @param array $params 参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function applyLayoutFile(array $params)
    {
        $this->validateParams($params, ['orgId']);
        
        return $this->requestBaseResponse('/v2/invoice/sdfile/applyLayoutFile', $params);
    }
    
    /**
     * 获取数电票版式文件
     * 
     * @param array $params 参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function getLayoutFile(array $params)
    {
        $this->validateParams($params, ['taskId']);
        
        return $this->requestBaseResponse('/v2/invoice/sdfile/getLayoutFile', $params);
    }
    
    /**
     * 单张数电版式下载
     * 
     * @param array $params 参数
     * @return BaseResponse
     * @throws QixiangyunException
     */
    public function syncLayoutFile(array $params)
    {
        $this->validateParams($params, ['orgId', 'fpdm', 'fphm']);
        
        return $this->requestBaseResponse('/v2/invoice/sdfile/syncLayoutFile', $params);
    }
}
