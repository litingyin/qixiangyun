<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Config;

class InvoiceClient extends BaseClient
{
    /**
     * 获取客户端名称
     *
     * @return string
     */
    public function getClientName(): string
    {
        return 'InvoiceClient';
    }
    
    /**
     * 查询增值税专用发票
     *
     * @param array $cyList 发票列表，每个发票包含fpdm(发票代码), fphm(发票号码), kprq(开票日期), je(金额)
     * @return array
     * @throws \Exception
     */
    public function queryZzsfpCy(array $cyList): array
    {
        $this->logDebug('查询增值税专用发票，参数: ' . json_encode($cyList, JSON_UNESCAPED_UNICODE));
        
        try {
            $response = $this->httpClient->post('v2/invoice/cy/zzsfpCy', [
                'cyList' => $cyList
            ]);
            
            $this->logInfo('查询增值税专用发票成功');
            return $response;
        } catch (\Exception $e) {
            $this->logError('查询增值税专用发票失败', $e);
            throw $e;
        }
    }
    
    /**
     * 查询增值税普通发票
     *
     * @param array $cyList 发票列表
     * @return array
     * @throws \Exception
     */
    public function queryPtfpCy(array $cyList): array
    {
        $this->logDebug('查询增值税普通发票，参数: ' . json_encode($cyList, JSON_UNESCAPED_UNICODE));
        
        try {
            $response = $this->httpClient->post('v2/invoice/cy/ptfpCy', [
                'cyList' => $cyList
            ]);
            
            $this->logInfo('查询增值税普通发票成功');
            return $response;
        } catch (\Exception $e) {
            $this->logError('查询增值税普通发票失败', $e);
            throw $e;
        }
    }
    
    /**
     * 查询机动车发票
     *
     * @param array $cyList 发票列表
     * @return array
     * @throws \Exception
     */
    public function queryJdcfpCy(array $cyList): array
    {
        $this->logDebug('查询机动车发票，参数: ' . json_encode($cyList, JSON_UNESCAPED_UNICODE));
        
        try {
            $response = $this->httpClient->post('v2/invoice/cy/jdcfpCy', [
                'cyList' => $cyList
            ]);
            
            $this->logInfo('查询机动车发票成功');
            return $response;
        } catch (\Exception $e) {
            $this->logError('查询机动车发票失败', $e);
            throw $e;
        }
    }
    
    /**
     * 查询二手车发票
     *
     * @param array $cyList 发票列表
     * @return array
     * @throws \Exception
     */
    public function queryEscfpCy(array $cyList): array
    {
        $this->logDebug('查询二手车发票，参数: ' . json_encode($cyList, JSON_UNESCAPED_UNICODE));
        
        try {
            $response = $this->httpClient->post('v2/invoice/cy/escfpCy', [
                'cyList' => $cyList
            ]);
            
            $this->logInfo('查询二手车发票成功');
            return $response;
        } catch (\Exception $e) {
            $this->logError('查询二手车发票失败', $e);
            throw $e;
        }
    }
    
    /**
     * 查询发票信息（通用方法）
     *
     * @param string $type 发票类型：zzsfp（增值税专用发票）、ptfp（增值税普通发票）、jdcfp（机动车发票）、escfp（二手车发票）
     * @param array $cyList 发票列表
     * @return array
     * @throws \Exception
     */
    public function queryInvoice(string $type, array $cyList): array
    {
        $validTypes = ['zzsfp', 'ptfp', 'jdcfp', 'escfp'];
        
        if (!in_array($type, $validTypes)) {
            throw new \InvalidArgumentException('Invalid invoice type: ' . $type);
        }
        
        $endpoint = 'v2/invoice/cy/' . $type . 'Cy';
        
        $this->logDebug('查询发票，类型: ' . $type . '，参数: ' . json_encode($cyList, JSON_UNESCAPED_UNICODE));
        
        try {
            $response = $this->httpClient->post($endpoint, [
                'cyList' => $cyList
            ]);
            
            $this->logInfo('查询发票成功，类型: ' . $type);
            return $response;
        } catch (\Exception $e) {
            $this->logError('查询发票失败，类型: ' . $type, $e);
            throw $e;
        }
    }
}