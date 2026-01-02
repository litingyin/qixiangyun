<?php

namespace QixiangyunSDK\Core;

/**
 * API响应对象
 * 支持链式操作和类型安全
 */
class Response
{
    /**
     * 响应数据
     *
     * @var array
     */
    protected $data;
    
    /**
     * 是否成功
     *
     * @var bool
     */
    protected $success;
    
    /**
     * 错误信息
     *
     * @var string|null
     */
    protected $error;
    
    /**
     * HTTP状态码
     *
     * @var int
     */
    protected $statusCode;
    
    /**
     * 构造函数
     *
     * @param array $data 响应数据
     * @param bool $success 是否成功
     * @param string|null $error 错误信息
     * @param int $statusCode HTTP状态码
     */
    public function __construct(array $data = [], bool $success = true, ?string $error = null, int $statusCode = 200)
    {
        $this->data = $data;
        $this->success = $success;
        $this->error = $error;
        $this->statusCode = $statusCode;
    }
    
    /**
     * 创建成功响应
     *
     * @param array $data 响应数据
     * @param int $statusCode HTTP状态码
     * @return self
     */
    public static function success(array $data = [], int $statusCode = 200): self
    {
        return new self($data, true, null, $statusCode);
    }
    
    /**
     * 创建失败响应
     *
     * @param string $error 错误信息
     * @param array $data 响应数据
     * @param int $statusCode HTTP状态码
     * @return self
     */
    public static function error(string $error, array $data = [], int $statusCode = 400): self
    {
        return new self($data, false, $error, $statusCode);
    }
    
    /**
     * 获取响应数据
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    
    /**
     * 获取指定键的数据
     *
     * @param string $key 键名
     * @param mixed $default 默认值
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }
    
    /**
     * 检查响应是否成功
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }
    
    /**
     * 获取错误信息
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
    
    /**
     * 获取HTTP状态码
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    
    /**
     * 转换为数组
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'success' => $this->success,
            'error' => $this->error,
            'statusCode' => $this->statusCode
        ];
    }
    
    /**
     * 转换为JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
    
    /**
     * 链式调用：获取数据并执行回调
     *
     * @param callable $callback 回调函数
     * @return self
     */
    public function then(callable $callback): self
    {
        if ($this->success) {
            $callback($this->data);
        }
        
        return $this;
    }
    
    /**
     * 链式调用：失败时执行回调
     *
     * @param callable $callback 回调函数
     * @return self
     */
    public function catch(callable $callback): self
    {
        if (!$this->success) {
            $callback($this->error, $this->statusCode);
        }
        
        return $this;
    }
    
    /**
     * 链式调用：无论成功失败都执行回调
     *
     * @param callable $callback 回调函数
     * @return self
     */
    public function finally(callable $callback): self
    {
        $callback($this);
        
        return $this;
    }

    /**
     * 设置数据
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * 设置错误信息
     */
    public function setError($error) {
        $this->error = $error;
    }
}