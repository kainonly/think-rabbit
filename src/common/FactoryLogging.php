<?php

namespace think\amqp;

use think\amqp\facade\AMQP;

/**
 * Class FactoryLogging
 * @package think\amqp
 */
final class FactoryLogging
{
    /**
     * 应用 ID
     * @var string
     */
    private $appid;

    /**
     * 交换器名称
     * @var string
     */
    private $exchangeName;

    /**
     * 路由键
     * @var string
     */
    private $routingKey;

    /**
     * 授权路径
     * @var string
     */
    private $virualhost;

    /**
     * FactoryLogging constructor.
     * @param string $appid
     * @param string $exchangeName
     * @param string $routingKey
     * @param string $virualhost
     */
    public function __construct(string $appid,
                                string $exchangeName,
                                string $routingKey = '',
                                string $virualhost = '/')
    {
        $this->appid = $appid;
        $this->exchangeName = $exchangeName;
        $this->routingKey = $routingKey;
        $this->virualhost = $virualhost;
    }

    /**
     * 收集数据推送至队列
     * @param string $namespace 授权空间
     * @param array $raws 收集数据
     */
    public function push(string $namespace,
                         array $raws = [])
    {
        AMQP::channel(function () use ($namespace, $raws) {
            AMQP::publish([
                'appid' => $this->appid,
                'namespace' => $namespace,
                'raws' => $raws,
            ], [
                'exchange' => $this->exchangeName,
                'routing_key' => $this->routingKey
            ]);
        }, [
            'virualhost' => $this->virualhost
        ]);
    }
}
