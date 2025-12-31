<?php

namespace QixiangyunSDK\Clients;

use QixiangyunSDK\Core\BaseClient;
use QixiangyunSDK\Core\Types\InvoiceResponse;

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
     * @return InvoiceResponse 支持链式操作的类型化响应
     * @throws \Exception
     */
    public function queryZzsfpCy(array $cyList): InvoiceResponse
    {
        return $this->requestInvoiceResponse('v2/invoice/cy/zzsfpCy', [
            'cyList' => $cyList
        ]);
    }
    
    /**
     * 查询增值税普通发票
     *
     * @param array $cyList 发票列表
     * @return InvoiceResponse 支持链式操作的类型化响应
     * @throws \Exception
     */
    public function queryPtfpCy(array $cyList): InvoiceResponse
    {
        return $this->requestInvoiceResponse('v2/invoice/cy/ptfpCy', [
            'cyList' => $cyList
        ]);
    }
    
    /**
     * 查询机动车发票
     *
     * @param array $cyList 发票列表
     * @return InvoiceResponse 支持链式操作的类型化响应
     * @throws \Exception
     */
    public function queryJdcfpCy(array $cyList): InvoiceResponse
    {
        return $this->requestInvoiceResponse('v2/invoice/cy/jdcfpCy', [
            'cyList' => $cyList
        ]);
    }
    
    /**
     * 查询二手车发票
     *
     * @param array $cyList 发票列表
     * @return InvoiceResponse 支持链式操作的类型化响应
     * @throws \Exception
     */
    public function queryEscfpCy(array $cyList): InvoiceResponse
    {
        return $this->requestInvoiceResponse('v2/invoice/cy/escfpCy', [
            'cyList' => $cyList
        ]);
    }
}