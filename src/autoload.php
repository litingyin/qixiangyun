<?php

/**
 * Qixiangyun SDK 自动加载器
 */

spl_autoload_register(function ($class) {
    // 项目命名空间前缀
    $prefix = 'QixiangyunSDK\\';
    
    // 基础目录
    $baseDir = __DIR__ . '/';
    
    // 检查类是否使用了命名空间前缀
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // 获取相对类名
    $relativeClass = substr($class, $len);
    
    // 将命名空间前缀替换为基础目录
    // 将命名空间分隔符转换为目录分隔符
    // 并在末尾添加 .php 扩展名
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    
    // 如果文件存在，则加载它
    if (file_exists($file)) {
        require $file;
    }
});
