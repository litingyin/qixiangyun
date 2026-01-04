<?php

namespace QixiangyunSDK\Core;

class Config
{
    /**
     * 应用密钥
     *
     * @var string
     */
    protected $appKey;
    
    /**
     * API主机地址
     *
     * @var string
     */
    protected $apiHost;
    
    /**
     * 应用密钥
     *
     * @var string
     */
    protected $appSecret;
    
    /**
     * 请求超时时间（秒）
     *
     * @var int
     */
    protected $timeout = 10;
    
    /**
     * 是否启用token缓存
     *
     * @var bool
     */
    protected $enableCache = true;
    
    /**
     * token缓存目录
     *
     * @var string
     */
    protected $cacheDir;

    /**
     * 定义地区编码常量
     */
    // 直辖市
    const AREA_CODE_BEIJING = '11';
    const AREA_CODE_TIANJIN = '12';
    const AREA_CODE_SHANGHAI = '31';
    const AREA_CODE_CHONGQING = '50';
    
    // 省份
    const AREA_CODE_HEBEI = '13';
    const AREA_CODE_SHANXI = '14';
    const AREA_CODE_NEIMENGGU = '15';
    const AREA_CODE_LIAONING = '21';
    const AREA_CODE_JILIN = '22';
    const AREA_CODE_HEILONGJIANG = '23';
    const AREA_CODE_JIANGSU = '32';
    const AREA_CODE_ZHEJIANG = '33';
    const AREA_CODE_ANHUI = '34';
    const AREA_CODE_FUJIAN = '35';
    const AREA_CODE_JIANGXI = '36';
    const AREA_CODE_SHANDONG = '37';
    const AREA_CODE_HENAN = '41';
    const AREA_CODE_HUBEI = '42';
    const AREA_CODE_HUNAN = '43';
    const AREA_CODE_GUANGDONG = '44';
    const AREA_CODE_GUANGXI = '45';
    const AREA_CODE_HAINAN = '46';
    const AREA_CODE_SICHUAN = '51';
    const AREA_CODE_GUIZHOU = '52';
    const AREA_CODE_YUNNAN = '53';
    const AREA_CODE_XIZANG = '54';
    const AREA_CODE_SHAANXI = '61';
    const AREA_CODE_GANSU = '62';
    const AREA_CODE_QINGHAI = '63';
    const AREA_CODE_NINGXIA = '64';
    const AREA_CODE_XINJIANG = '65';
    
    // 副省级城市
    const AREA_CODE_DALIAN = '2102';      // 辽宁省大连市
    const AREA_CODE_NINGBO = '3302';      // 浙江省宁波市
    const AREA_CODE_XIAMEN = '3502';      // 福建省厦门市
    const AREA_CODE_QINGDAO = '3702';     // 山东省青岛市
    const AREA_CODE_SHENZHEN = '4403';    // 广东省深圳市
    

    /**
     * 地区代码
     * @var array
     */
    protected $areaCode = [
        self::AREA_CODE_BEIJING => '北京市',
        self::AREA_CODE_TIANJIN => '天津市',
        self::AREA_CODE_HEBEI => '河北省',
        self::AREA_CODE_SHANXI => '山西省',
        self::AREA_CODE_NEIMENGGU => '内蒙古自治区',
        self::AREA_CODE_LIAONING => '辽宁省',
        self::AREA_CODE_DALIAN => '大连市',
        self::AREA_CODE_JILIN => '吉林省',
        self::AREA_CODE_HEILONGJIANG => '黑龙江省',
        self::AREA_CODE_SHANGHAI => '上海市',
        self::AREA_CODE_JIANGSU => '江苏省',
        self::AREA_CODE_ZHEJIANG => '浙江省',
        self::AREA_CODE_NINGBO => '宁波市',
        self::AREA_CODE_ANHUI => '安徽省',
        self::AREA_CODE_FUJIAN => '福建省',
        self::AREA_CODE_XIAMEN => '厦门市',
        self::AREA_CODE_JIANGXI => '江西省',
        self::AREA_CODE_SHANDONG => '山东省',
        self::AREA_CODE_QINGDAO => '青岛市',
        self::AREA_CODE_HENAN => '河南省',
        self::AREA_CODE_HUBEI => '湖北省',
        self::AREA_CODE_HUNAN => '湖南省',
        self::AREA_CODE_GUANGDONG => '广东省',
        self::AREA_CODE_SHENZHEN => '深圳市',
        self::AREA_CODE_GUANGXI => '广西',
        self::AREA_CODE_HAINAN => '海南省',
        self::AREA_CODE_CHONGQING => '重庆市',
        self::AREA_CODE_SICHUAN => '四川省',
        self::AREA_CODE_GUIZHOU => '贵州省',
        self::AREA_CODE_YUNNAN => '云南省',
        self::AREA_CODE_XIZANG => '西藏',
        self::AREA_CODE_SHAANXI => '陕西省',
        self::AREA_CODE_GANSU => '甘肃省',
        self::AREA_CODE_QINGHAI => '青海省',
        self::AREA_CODE_NINGXIA => '宁夏',
        self::AREA_CODE_XINJIANG => '新疆',
    ];

    /**
     * 产品编码常量
     */
    const PRODUCT_CODE_INVOICE_CHECK = '0001';
    const PRODUCT_CODE_INVOICE_CHECK_EXTEND = '0007';
    const PRODUCT_CODE_INVOICE_RECOGNITION = '0041';
    const PRODUCT_CODE_INVOICE_ISSUE = '0004';
    const PRODUCT_CODE_INVOICE_AUTH = '0003';
    const PRODUCT_CODE_INVOICE_AUTH_GROUP = '0015';
    const PRODUCT_CODE_INVOICE_ENTRY = '0070';
    const PRODUCT_CODE_INVOICE_COLLECT = '0017';
    const PRODUCT_CODE_INVOICE_COLLECT_GROUP = '0009';
    const PRODUCT_CODE_INVOICE_DOWNLOAD = '0018';
    const PRODUCT_CODE_INVOICE_DOWNLOAD_ENTERPRISE = '0005';

    /**
     * 产品编码
     * @var array
     */
    protected $productCodes = [
        self::PRODUCT_CODE_INVOICE_CHECK => '发票查验(标准版)',
        self::PRODUCT_CODE_INVOICE_CHECK_EXTEND => '发票查验(扩展版)',
        self::PRODUCT_CODE_INVOICE_RECOGNITION => '票据识别',
        self::PRODUCT_CODE_INVOICE_ISSUE => '数电开票',
        self::PRODUCT_CODE_INVOICE_AUTH => '发票认证(代账版)',
        self::PRODUCT_CODE_INVOICE_AUTH_GROUP => '发票认证(集团版)',
        self::PRODUCT_CODE_INVOICE_ENTRY => '发票入账',
        self::PRODUCT_CODE_INVOICE_COLLECT => '发票归集(代账版)',
        self::PRODUCT_CODE_INVOICE_COLLECT_GROUP => '发票归集(集团版)',
        self::PRODUCT_CODE_INVOICE_DOWNLOAD => '数电票版式文件下载(代账版)',
        self::PRODUCT_CODE_INVOICE_DOWNLOAD_ENTERPRISE => '数电票版式文件下载(企业版)',
    ];
    
    /**
     * 默认配置
     *
     * @var array
     */
    protected $defaultConfig = [
        'timeout' => 10,
        'enableCache' => true,
        'cacheDir' => null, // 默认使用系统临时目录
    ];
    
    /**
     * 构造函数
     *
     * @param array $config 配置数组
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        // 合并默认配置
        $config = array_merge($this->defaultConfig, $config);
        
        // 验证必需配置
        if (empty($config['appKey'])) {
            throw new \Exception('appKey is required');
        }
        
        if (empty($config['apiHost'])) {
            throw new \Exception('apiHost is required');
        }
        
        if (empty($config['appSecret'])) {
            throw new \Exception('appSecret is required');
        }
        
        // 设置配置
        $this->appKey = $config['appKey'];
        $this->apiHost = $config['apiHost'];
        $this->appSecret = $config['appSecret'];
        $this->timeout = (int)$config['timeout'];
        $this->enableCache = (bool)$config['enableCache'];
        
        // 设置缓存目录
        if (!empty($config['cacheDir'])) {
            $this->cacheDir = $config['cacheDir'];
        } else {
            $this->cacheDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'qixiangyun_sdk_cache';
        }
        
        // 确保缓存目录存在
        if ($this->enableCache && !is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }
    
    /**
     * 获取应用密钥
     *
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }
    
    /**
     * 获取API主机地址
     *
     * @return string
     */
    public function getApiHost(): string
    {
        return $this->apiHost;
    }
    
    /**
     * 获取应用密钥
     *
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }
    
    /**
     * 获取请求超时时间
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
    
    /**
     * 是否启用token缓存
     *
     * @return bool
     */
    public function isEnableCache(): bool
    {
        return $this->enableCache;
    }
    
    /**
     * 获取缓存目录
     *
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }
    
    /**
     * 获取完整的API URL
     *
     * @param string $endpoint API端点
     * @return string
     */
    public function getApiUrl(string $endpoint): string
    {
        return rtrim($this->apiHost, '/') . '/' . ltrim($endpoint, '/');
    }
    
    /**
     * 获取地区名称
     *
     * @param string $areaCode 地区编码
     * @return string 地区名称，如果找不到则返回原编码
     */
    public function getAreaName(string $areaCode): string
    {
        return $this->areaCode[$areaCode] ?? $areaCode;
    }

    /**
     * 获取所有地区编码和名称
     *
     * @return array 地区编码 => 地区名称的数组
     */
    public function getAllAreas(): array
    {
        return $this->areaCode;
    }

    /**
     * 获取产品名称
     *
     * @param string $productCode 产品编码
     * @return string 产品名称，如果找不到则返回原编码
     */
    public function getProductName(string $productCode): string
    {
        return $this->productCodes[$productCode] ?? $productCode;
    }

    /**
     * 获取所有产品编码和名称
     *
     * @return array 产品编码 => 产品名称的数组
     */
    public function getAllProducts(): array
    {
        return $this->productCodes;
    }

    /**
     * 更新配置
     *
     * @param array $config 新配置
     * @return void
     */
    public function update(array $config): void
    {
        $this->__construct(array_merge([
            'appKey' => $this->appKey,
            'apiHost' => $this->apiHost,
            'appSecret' => $this->appSecret,
            'timeout' => $this->timeout,
            'enableCache' => $this->enableCache,
            'cacheDir' => $this->cacheDir,
        ], $config));
    }
}