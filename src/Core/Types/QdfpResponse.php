<?php

namespace QixiangyunSDK\Core\Types;

use QixiangyunSDK\Core\Response;

/**
 * 前台发票响应类
 * 提供前台发票相关API的返回值类型定义和链式操作
 */
class QdfpResponse extends Response
{
    /**
     * 获取识别结果
     *
     * @return array
     */
    public function getOcrResult(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取企业基本信息
     *
     * @return array
     */
    public function getOrgInfo(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取企业名称
     *
     * @return string
     */
    public function getOrgName(): string
    {
        return $this->get('data.qymc', '');
    }

    /**
     * 获取纳税人识别号
     *
     * @return string
     */
    public function getTaxId(): string
    {
        return $this->get('data.nsrsbh', '');
    }

    /**
     * 获取扫脸时长(秒)
     *
     * @return int
     */
    public function getFaceDuration(): int
    {
        return (int) $this->get('data.duration', 0);
    }

    /**
     * 获取人脸识别二维码URL
     *
     * @return string
     */
    public function getFaceQrcodeUrl(): string
    {
        return $this->get('data.qrcodeUrl', '');
    }

    /**
     * 获取人脸识别任务ID
     *
     * @return string
     */
    public function getFaceTaskId(): string
    {
        return $this->get('data.taskId', '');
    }

    /**
     * 获取人脸识别结果
     *
     * @return array
     */
    public function getFaceResult(): array
    {
        return $this->get('data', []);
    }

    /**
     * 检查人脸识别是否成功
     *
     * @return bool
     */
    public function isFaceAuthSuccess(): bool
    {
        return $this->get('data.status', '') === 'success' || $this->get('data.result', '') === 'success';
    }

    /**
     * 获取成品油库存信息
     *
     * @return array
     */
    public function getOilStock(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取开票额度信息
     *
     * @return array
     */
    public function getQuotaInfo(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取可开票金额
     *
     * @return float
     */
    public function getAvailableQuota(): float
    {
        return (float) $this->get('data.kje', 0);
    }

    /**
     * 获取已开票金额
     *
     * @return float
     */
    public function getUsedQuota(): float
    {
        return (float) $this->get('data.yje', 0);
    }

    /**
     * 获取红字信息表ID
     *
     * @return string
     */
    public function getRedInfoId(): string
    {
        return $this->get('data.hzxxbId', '');
    }

    /**
     * 获取红字信息列表
     *
     * @return array
     */
    public function getRedInfoList(): array
    {
        return $this->get('data.list', []);
    }

    /**
     * 获取红字信息明细
     *
     * @return array
     */
    public function getRedInfoDetail(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取已开发票列表
     *
     * @return array
     */
    public function getInvoiceList(): array
    {
        return $this->get('data.list', []);
    }

    /**
     * 获取已开发票明细
     *
     * @return array
     */
    public function getInvoiceDetail(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取已开发票统计
     *
     * @return array
     */
    public function getInvoiceStats(): array
    {
        return $this->get('data', []);
    }

    /**
     * 获取版式文件下载URL
     *
     * @return array
     */
    public function getDownloadUrls(): array
    {
        return $this->get('data.urls', []);
    }

    /**
     * 获取额度调整申请ID
     *
     * @return string
     */
    public function getQuotaApplyId(): string
    {
        return $this->get('data.sqId', '');
    }

    /**
     * 获取额度申请列表
     *
     * @return array
     */
    public function getQuotaApplyList(): array
    {
        return $this->get('data.list', []);
    }

    /**
     * 链式操作：处理OCR识别结果
     *
     * @param callable $callback 处理识别结果的回调
     * @return self
     */
    public function processOcrResult(callable $callback): self
    {
        if ($this->isSuccess()) {
            $ocrResult = $this->getOcrResult();
            return $callback($ocrResult, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理企业信息
     *
     * @param callable $callback 处理企业信息的回调
     * @return self
     */
    public function processOrgInfo(callable $callback): self
    {
        if ($this->isSuccess()) {
            $orgInfo = [
                'orgName' => $this->getOrgName(),
                'taxId' => $this->getTaxId(),
                'raw' => $this->getOrgInfo()
            ];
            return $callback($orgInfo, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理人脸识别结果
     *
     * @param callable $callback 处理人脸识别结果的回调
     * @return self
     */
    public function processFaceResult(callable $callback): self
    {
        if ($this->isSuccess()) {
            $faceResult = [
                'taskId' => $this->getFaceTaskId(),
                'status' => $this->get('data.status', ''),
                'result' => $this->get('data.result', ''),
                'isSuccess' => $this->isFaceAuthSuccess(),
                'raw' => $this->getFaceResult()
            ];
            return $callback($faceResult, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理开票额度信息
     *
     * @param callable $callback 处理额度信息的回调
     * @return self
     */
    public function processQuotaInfo(callable $callback): self
    {
        if ($this->isSuccess()) {
            $quotaInfo = [
                'available' => $this->getAvailableQuota(),
                'used' => $this->getUsedQuota(),
                'raw' => $this->getQuotaInfo()
            ];
            return $callback($quotaInfo, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理红字信息列表
     *
     * @param callable $callback 处理红字信息的回调
     * @return self
     */
    public function processRedInfo(callable $callback): self
    {
        if ($this->isSuccess()) {
            $redInfoList = $this->getRedInfoList();
            return $callback($redInfoList, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理已开发票列表
     *
     * @param callable $callback 处理发发票列表的回调
     * @return self
     */
    public function processInvoiceList(callable $callback): self
    {
        if ($this->isSuccess()) {
            $invoiceList = $this->getInvoiceList();
            return $callback($invoiceList, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理已开发票明细
     *
     * @param callable $callback 处理发发票明细的回调
     * @return self
     */
    public function processInvoiceDetail(callable $callback): self
    {
        if ($this->isSuccess()) {
            $invoiceDetail = $this->getInvoiceDetail();
            return $callback($invoiceDetail, $this);
        }
        return $this;
    }

    /**
     * 链式操作：处理已开发票统计
     *
     * @param callable $callback 处理发发票统计的回调
     * @return self
     */
    public function processInvoiceStats(callable $callback): self
    {
        if ($this->isSuccess()) {
            $invoiceStats = $this->getInvoiceStats();
            return $callback($invoiceStats, $this);
        }
        return $this;
    }

    /**
     * 链式操作：过滤已开发票列表
     *
     * @param callable $filter 过滤条件回调
     * @return self
     */
    public function filterInvoices(callable $filter): self
    {
        if ($this->isSuccess()) {
            $invoiceList = $this->getInvoiceList();
            $filtered = array_filter($invoiceList, $filter);
            $this->data['data']['list'] = array_values($filtered);
        }
        return $this;
    }

    /**
     * 链式操作：排序已开发票列表
     *
     * @param string $field 排序字段
     * @param string $direction 排序方向 asc|desc
     * @return self
     */
    public function sortInvoices(string $field, string $direction = 'asc'): self
    {
        if ($this->isSuccess()) {
            $invoiceList = $this->getInvoiceList();
            usort($invoiceList, function ($a, $b) use ($field, $direction) {
                $valA = $a[$field] ?? null;
                $valB = $b[$field] ?? null;

                if ($valA == $valB) {
                    return 0;
                }

                $result = $valA <=> $valB;
                return $direction === 'desc' ? -$result : $result;
            });
            $this->data['data']['list'] = $invoiceList;
        }
        return $this;
    }

    /**
     * 链式操作：限制已开发票列表数量
     *
     * @param int $limit 限制数量
     * @return self
     */
    public function limitInvoices(int $limit): self
    {
        if ($this->isSuccess()) {
            $invoiceList = $this->getInvoiceList();
            $this->data['data']['list'] = array_slice($invoiceList, 0, $limit);
        }
        return $this;
    }

    /**
     * 链式操作：格式化发票数据
     *
     * @param string $format 格式类型 (array|json)
     * @return self
     */
    public function formatInvoiceData(string $format = 'array'): self
    {
        if ($this->isSuccess()) {
            $invoiceList = $this->getInvoiceList();

            if ($format === 'json') {
                $this->data['data']['formatted'] = json_encode($invoiceList, JSON_UNESCAPED_UNICODE);
            } else {
                $this->data['data']['formatted'] = $invoiceList;
            }
        }
        return $this;
    }

    /**
     * 链式操作：过滤红字信息列表
     *
     * @param callable $filter 过滤条件回调
     * @return self
     */
    public function filterRedInfo(callable $filter): self
    {
        if ($this->isSuccess()) {
            $redInfoList = $this->getRedInfoList();
            $filtered = array_filter($redInfoList, $filter);
            $this->data['data']['list'] = array_values($filtered);
        }
        return $this;
    }

    /**
     * 链式操作：排序红字信息列表
     *
     * @param string $field 排序字段
     * @param string $direction 排序方向 asc|desc
     * @return self
     */
    public function sortRedInfo(string $field, string $direction = 'asc'): self
    {
        if ($this->isSuccess()) {
            $redInfoList = $this->getRedInfoList();
            usort($redInfoList, function ($a, $b) use ($field, $direction) {
                $valA = $a[$field] ?? null;
                $valB = $b[$field] ?? null;

                if ($valA == $valB) {
                    return 0;
                }

                $result = $valA <=> $valB;
                return $direction === 'desc' ? -$result : $result;
            });
            $this->data['data']['list'] = $redInfoList;
        }
        return $this;
    }

    /**
     * 链式操作：处理额度申请列表
     *
     * @param callable $callback 处理额度申请列表的回调
     * @return self
     */
    public function processQuotaApplyList(callable $callback): self
    {
        if ($this->isSuccess()) {
            $applyList = $this->getQuotaApplyList();
            return $callback($applyList, $this);
        }
        return $this;
    }

    /**
     * 链式操作：过滤额度申请列表
     *
     * @param callable $filter 过滤条件回调
     * @return self
     */
    public function filterQuotaApplies(callable $filter): self
    {
        if ($this->isSuccess()) {
            $applyList = $this->getQuotaApplyList();
            $filtered = array_filter($applyList, $filter);
            $this->data['data']['list'] = array_values($filtered);
        }
        return $this;
    }

    /**
     * 链式操作：排序额度申请列表
     *
     * @param string $field 排序字段
     * @param string $direction 排序方向 asc|desc
     * @return self
     */
    public function sortQuotaApplies(string $field, string $direction = 'asc'): self
    {
        if ($this->isSuccess()) {
            $applyList = $this->getQuotaApplyList();
            usort($applyList, function ($a, $b) use ($field, $direction) {
                $valA = $a[$field] ?? null;
                $valB = $b[$field] ?? null;

                if ($valA == $valB) {
                    return 0;
                }

                $result = $valA <=> $valB;
                return $direction === 'desc' ? -$result : $result;
            });
            $this->data['data']['list'] = $applyList;
        }
        return $this;
    }

    /**
     * 链式操作：处理成品油库存信息
     *
     * @param callable $callback 处理库存信息的回调
     * @return self
     */
    public function processOilStock(callable $callback): self
    {
        if ($this->isSuccess()) {
            $oilStock = $this->getOilStock();
            return $callback($oilStock, $this);
        }
        return $this;
    }

    /**
     * 检查是否有已开发票
     *
     * @return bool
     */
    public function hasInvoices(): bool
    {
        return $this->isSuccess() && count($this->getInvoiceList()) > 0;
    }

    /**
     * 检查是否有红字信息
     *
     * @return bool
     */
    public function hasRedInfo(): bool
    {
        return $this->isSuccess() && count($this->getRedInfoList()) > 0;
    }

    /**
     * 检查是否有额度申请
     *
     * @return bool
     */
    public function hasQuotaApplies(): bool
    {
        return $this->isSuccess() && count($this->getQuotaApplyList()) > 0;
    }

    /**
     * 获取发票总数
     *
     * @return int
     */
    public function getInvoiceCount(): int
    {
        return count($this->getInvoiceList());
    }

    /**
     * 获取红字信息总数
     *
     * @return int
     */
    public function getRedInfoCount(): int
    {
        return count($this->getRedInfoList());
    }

    /**
     * 获取额度申请总数
     *
     * @return int
     */
    public function getQuotaApplyCount(): int
    {
        return count($this->getQuotaApplyList());
    }
}
