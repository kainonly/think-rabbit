<?php
declare (strict_types=1);

namespace think\amqp\contract;

use Closure;
use simplify\amqp\AMQPClient;

interface AMQPInterface
{
    /**
     * AMQP 客户端
     * @param string $name 配置标识
     * @return AMQPClient
     */
    public function client(string $name): AMQPClient;

    /**
     * 创建信道
     * @param Closure $closure
     * @param array $options
     */
    public function channel(Closure $closure, array $options = []): void;

    /**
     * 创建事务信道
     * @param Closure $closure
     * @param array $options
     */
    public function channeltx(Closure $closure, array $options = []): void;
}