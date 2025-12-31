<?php

namespace QixiangyunSDK\Core;

use QixiangyunSDK\Core\Config;
use QixiangyunSDK\Core\HttpClient;
use QixiangyunSDK\Core\Response;
use QixiangyunSDK\Core\ResponseBuilder;
use QixiangyunSDK\Core\Types\InvoiceResponse;
use QixiangyunSDK\Core\Types\OrgResponse;
use QixiangyunSDK\Core\Types\TaxResponse;
use QixiangyunSDK\Core\Types\ProductResponse;
use QixiangyunSDK\Core\Types\AccountResponse;
use QixiangyunSDK\Core\Types\BsryglResponse;
use QixiangyunSDK\Core\Types\CktsResponse;
use QixiangyunSDK\Core\Types\CollectResponse;
use QixiangyunSDK\Core\Types\CustomsResponse;
use QixiangyunSDK\Core\Types\FpruzResponse;
use QixiangyunSDK\Core\Types\GjResponse;
use QixiangyunSDK\Core\Types\KhxxResponse;
use QixiangyunSDK\Core\Types\LegislationResponse;
use QixiangyunSDK\Core\Types\LoginResponse;
use QixiangyunSDK\Core\Types\MessageResponse;
use QixiangyunSDK\Core\Types\PhoneResponse;
use QixiangyunSDK\Core\Types\QdfpResponse;
use QixiangyunSDK\Core\Types\BaseResponse;
use QixiangyunSDK\Exceptions\QixiangyunException;

abstract class BaseClient
{
    /**
     * HTTP客户端
     *
     * @var HttpClient
     */
    protected $httpClient;
    
    /**
     * SDK配置
     *
     * @var Config
     */
    protected $config;
    
    /**
     * 响应类型映射
     *
     * @var array
     */
    protected $responseTypes = [
        'invoice' => InvoiceResponse::class,
        'org' => OrgResponse::class,
        'tax' => TaxResponse::class,
        'product' => ProductResponse::class,
        'account' => AccountResponse::class,
        'bsrygl' => BsryglResponse::class,
        'ckts' => CktsResponse::class,
        'collect' => CollectResponse::class,
        'customs' => CustomsResponse::class,
        'fpruz' => FpruzResponse::class,
        'gj' => GjResponse::class,
        'khxx' => KhxxResponse::class,
        'legislation' => LegislationResponse::class,
        'login' => LoginResponse::class,
        'message' => MessageResponse::class,
        'phone' => PhoneResponse::class,
        'qdfp' => QdfpResponse::class,
        'base' => BaseResponse::class
    ];
    
    /**
     * 构造函数
     *
     * @param Config $config SDK配置
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new HttpClient($config);
    }
    
    /**
     * 获取客户端名称
     *
     * @return string
     */
    abstract public function getClientName(): string;
    
    /**
     * 验证参数
     *
     * @param array $params 待验证的参数
     * @param array $required 必需的参数字段
     * @throws QixiangyunException
     */
    protected function validateParams(array $params, array $required): void
    {
        foreach ($required as $field) {
            if (!isset($params[$field]) || $params[$field] === '') {
                throw new QixiangyunException("Missing required parameter: {$field}");
            }
        }
    }
    
    /**
     * 发送HTTP请求并返回原始数据
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return array
     * @throws QixiangyunException
     */
    protected function request(string $endpoint, array $params = [], string $method = 'POST'): array
    {
        try {
            $this->logDebug("Sending request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $response = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Request successful: {$endpoint}");
            
            return $response;
        } catch (\Exception $e) {
            $this->logError("Request failed: {$endpoint}", $e);
            throw new QixiangyunException("Request failed: " . $e->getMessage(), null, null, 0, $e);
        }
    }
    
    /**
     * 发送HTTP请求并返回通用响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return Response
     * @throws QixiangyunException
     */
    protected function requestWithResponse(string $endpoint, array $params = [], string $method = 'POST'): Response
    {
        try {
            $this->logDebug("Sending request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Request successful: {$endpoint}");
            
            return Response::success($data);
        } catch (\Exception $e) {
            $this->logError("Request failed: {$endpoint}", $e);
            return Response::error($e->getMessage(), [], 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回发票类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return InvoiceResponse
     * @throws QixiangyunException
     */
    protected function requestInvoiceResponse(string $endpoint, array $params = [], string $method = 'POST'): InvoiceResponse
    {
        try {
            $this->logDebug("Sending invoice request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Invoice request successful: {$endpoint}");
            
            return ResponseBuilder::invoice($data);
        } catch (\Exception $e) {
            $this->logError("Invoice request failed: {$endpoint}", $e);
            return new InvoiceResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回企业类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return OrgResponse
     * @throws QixiangyunException
     */
    protected function requestOrgResponse(string $endpoint, array $params = [], string $method = 'POST'): OrgResponse
    {
        try {
            $this->logDebug("Sending org request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Org request successful: {$endpoint}");
            
            return ResponseBuilder::org($data);
        } catch (\Exception $e) {
            $this->logError("Org request failed: {$endpoint}", $e);
            return new OrgResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回税务类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return TaxResponse
     * @throws QixiangyunException
     */
    protected function requestTaxResponse(string $endpoint, array $params = [], string $method = 'POST'): TaxResponse
    {
        try {
            $this->logDebug("Sending tax request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Tax request successful: {$endpoint}");
            
            return ResponseBuilder::tax($data);
        } catch (\Exception $e) {
            $this->logError("Tax request failed: {$endpoint}", $e);
            return new TaxResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回产品类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return ProductResponse
     * @throws QixiangyunException
     */
    protected function requestProductResponse(string $endpoint, array $params = [], string $method = 'POST'): ProductResponse
    {
        try {
            $this->logDebug("Sending product request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Product request successful: {$endpoint}");
            
            return ResponseBuilder::product($data);
        } catch (\Exception $e) {
            $this->logError("Product request failed: {$endpoint}", $e);
            return new ProductResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回账户类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return AccountResponse
     * @throws QixiangyunException
     */
    protected function requestAccountResponse(string $endpoint, array $params = [], string $method = 'POST'): AccountResponse
    {
        try {
            $this->logDebug("Sending account request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Account request successful: {$endpoint}");
            
            return ResponseBuilder::account($data);
        } catch (\Exception $e) {
            $this->logError("Account request failed: {$endpoint}", $e);
            return new AccountResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回办税人员类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return BsryglResponse
     * @throws QixiangyunException
     */
    protected function requestBsryglResponse(string $endpoint, array $params = [], string $method = 'POST'): BsryglResponse
    {
        try {
            $this->logDebug("Sending bsrygl request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Bsrygl request successful: {$endpoint}");
            
            return ResponseBuilder::bsrygl($data);
        } catch (\Exception $e) {
            $this->logError("Bsrygl request failed: {$endpoint}", $e);
            return new BsryglResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回出口退税类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return CktsResponse
     * @throws QixiangyunException
     */
    protected function requestCktsResponse(string $endpoint, array $params = [], string $method = 'POST'): CktsResponse
    {
        try {
            $this->logDebug("Sending ckts request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Ckts request successful: {$endpoint}");
            
            return ResponseBuilder::ckts($data);
        } catch (\Exception $e) {
            $this->logError("Ckts request failed: {$endpoint}", $e);
            return new CktsResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回企业采集类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return CollectResponse
     * @throws QixiangyunException
     */
    protected function requestCollectResponse(string $endpoint, array $params = [], string $method = 'POST'): CollectResponse
    {
        try {
            $this->logDebug("Sending collect request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Collect request successful: {$endpoint}");
            
            return ResponseBuilder::collect($data);
        } catch (\Exception $e) {
            $this->logError("Collect request failed: {$endpoint}", $e);
            return new CollectResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回海关类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return CustomsResponse
     * @throws QixiangyunException
     */
    protected function requestCustomsResponse(string $endpoint, array $params = [], string $method = 'POST'): CustomsResponse
    {
        try {
            $this->logDebug("Sending customs request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Customs request successful: {$endpoint}");
            
            return ResponseBuilder::customs($data);
        } catch (\Exception $e) {
            $this->logError("Customs request failed: {$endpoint}", $e);
            return new CustomsResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回发票入账类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return FpruzResponse
     * @throws QixiangyunException
     */
    protected function requestFpruzResponse(string $endpoint, array $params = [], string $method = 'POST'): FpruzResponse
    {
        try {
            $this->logDebug("Sending fpruz request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Fpruz request successful: {$endpoint}");
            
            return ResponseBuilder::fpruz($data);
        } catch (\Exception $e) {
            $this->logError("Fpruz request failed: {$endpoint}", $e);
            return new FpruzResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回发票归集类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return GjResponse
     * @throws QixiangyunException
     */
    protected function requestGjResponse(string $endpoint, array $params = [], string $method = 'POST'): GjResponse
    {
        try {
            $this->logDebug("Sending gj request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Gj request successful: {$endpoint}");
            
            return ResponseBuilder::gj($data);
        } catch (\Exception $e) {
            $this->logError("Gj request failed: {$endpoint}", $e);
            return new GjResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回基础类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return BaseResponse
     * @throws QixiangyunException
     */
    protected function requestBaseResponse(string $endpoint, array $params = [], string $method = 'POST'): BaseResponse
    {
        try {
            $this->logDebug("Sending base request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Base request successful: {$endpoint}");
            
            return ResponseBuilder::base($data);
        } catch (\Exception $e) {
            $this->logError("Base request failed: {$endpoint}", $e);
            return new BaseResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回客户信息类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return KhxxResponse
     * @throws QixiangyunException
     */
    protected function requestKhxxResponse(string $endpoint, array $params = [], string $method = 'POST'): KhxxResponse
    {
        try {
            $this->logDebug("Sending khxx request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Khxx request successful: {$endpoint}");
            
            return ResponseBuilder::khxx($data);
        } catch (\Exception $e) {
            $this->logError("Khxx request failed: {$endpoint}", $e);
            return new KhxxResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回政策法规类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return LegislationResponse
     * @throws QixiangyunException
     */
    protected function requestLegislationResponse(string $endpoint, array $params = [], string $method = 'POST'): LegislationResponse
    {
        try {
            $this->logDebug("Sending legislation request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Legislation request successful: {$endpoint}");
            
            return ResponseBuilder::legislation($data);
        } catch (\Exception $e) {
            $this->logError("Legislation request failed: {$endpoint}", $e);
            return new LegislationResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回登录类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return LoginResponse
     * @throws QixiangyunException
     */
    protected function requestLoginResponse(string $endpoint, array $params = [], string $method = 'POST'): LoginResponse
    {
        try {
            $this->logDebug("Sending login request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Login request successful: {$endpoint}");
            
            return ResponseBuilder::login($data);
        } catch (\Exception $e) {
            $this->logError("Login request failed: {$endpoint}", $e);
            return new LoginResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回消息类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return MessageResponse
     * @throws QixiangyunException
     */
    protected function requestMessageResponse(string $endpoint, array $params = [], string $method = 'POST'): MessageResponse
    {
        try {
            $this->logDebug("Sending message request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Message request successful: {$endpoint}");
            
            return ResponseBuilder::message($data);
        } catch (\Exception $e) {
            $this->logError("Message request failed: {$endpoint}", $e);
            return new MessageResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回办税小号类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return PhoneResponse
     * @throws QixiangyunException
     */
    protected function requestPhoneResponse(string $endpoint, array $params = [], string $method = 'POST'): PhoneResponse
    {
        try {
            $this->logDebug("Sending phone request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Phone request successful: {$endpoint}");
            
            return ResponseBuilder::phone($data);
        } catch (\Exception $e) {
            $this->logError("Phone request failed: {$endpoint}", $e);
            return new PhoneResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 发送HTTP请求并返回前台发票类型响应
     *
     * @param string $endpoint 接口端点
     * @param array $params 请求参数
     * @param string $method 请求方法，默认为POST
     * @return QdfpResponse
     * @throws QixiangyunException
     */
    protected function requestQdfpResponse(string $endpoint, array $params = [], string $method = 'POST'): QdfpResponse
    {
        try {
            $this->logDebug("Sending qdfp request to: {$endpoint} with params: " . json_encode($params, JSON_UNESCAPED_UNICODE));
            
            $data = $this->httpClient->post($endpoint, $params);
            
            $this->logInfo("Qdfp request successful: {$endpoint}");
            
            return ResponseBuilder::qdfp($data);
        } catch (\Exception $e) {
            $this->logError("Qdfp request failed: {$endpoint}", $e);
            return new QdfpResponse([], false, $e->getMessage(), 500);
        }
    }
    
    /**
     * 记录日志
     *
     * @param string $message 日志消息
     * @param string $level 日志级别
     * @return void
     */
    protected function log(string $message, string $level = 'info'): void
    {
        $logMessage = sprintf(
            '[%s] [%s] %s',
            date('Y-m-d H:i:s'),
            $level,
            $message
        );
        
        // 这里可以扩展为写入文件或使用Monolog等日志库
        error_log($logMessage);
    }
    
    /**
     * 记录错误日志
     *
     * @param string $message 错误消息
     * @param \Exception $exception 异常对象
     * @return void
     */
    protected function logError(string $message, \Exception $exception = null): void
    {
        $errorMessage = $message;
        
        if ($exception) {
            $errorMessage .= ': ' . $exception->getMessage();
        }
        
        $this->log($errorMessage, 'error');
    }
    
    /**
     * 记录调试日志
     *
     * @param string $message 调试消息
     * @return void
     */
    protected function logDebug(string $message): void
    {
        $this->log($message, 'debug');
    }
    
    /**
     * 记录信息日志
     *
     * @param string $message 信息消息
     * @return void
     */
    protected function logInfo(string $message): void
    {
        $this->log($message, 'info');
    }
    
    /**
     * 记录警告日志
     *
     * @param string $message 警告消息
     * @return void
     */
    protected function logWarning(string $message): void
    {
        $this->log($message, 'warning');
    }
}