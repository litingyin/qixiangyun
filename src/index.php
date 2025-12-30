<?php

/**
 * Qixiangyun SDK 主入口文件
 */

// 引入自动加载器
require_once __DIR__ . '/autoload.php';

// 导入核心类
use QixiangyunSDK\SDK;

// 如果不需要，可以注释掉下面的导出
if (!function_exists('QixiangyunSDK')) {
    function QixiangyunSDK(array $config)
    {
        return SDK::create($config);
    }
}