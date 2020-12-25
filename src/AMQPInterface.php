<?php
declare (strict_types=1);

namespace think\amqp;

use Closure;
use simplify\amqp\AMQPClient;

interface AMQPInterface
{
    /**
     * AMQP 客户端
     * @param string $name 配置标识
     * @return AMQPClient
     */
    public function client(string $name = 'default'): AMQPClient;

    /**
     * 创建信道
     * @param Closure $closure
     * @param string $name 配置标识
     * @param array $options 信道参数
     */
    public function channel(Closure $closure, string $name = 'default', array $options = []): void;

    /**
     * 创建事务信道
     * @param Closure $closure
     * @param string $name 配置标识
     * @param array $options 信道参数
     */
    public function channeltx(Closure $closure, string $name = 'default', array $options = []): void;
}