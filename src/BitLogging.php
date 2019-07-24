<?php

namespace think\logging;

use think\amqp\Rabbit;
use think\facade\Config;

/**
 * Class BitLogging
 * @package think\logging
 */
final class BitLogging
{
    private $appid;
    private $exchange;

    public function __construct()
    {
        $config = Config::get('queue.logging');
        $this->exchange = $config['exchange'];
        $this->appid = Config::get('app.app_id');
    }

    /**
     * 信息收集推送
     * @param string $namespace 行为命名
     * @param array $raws 原始数据
     */
    public function push($namespace, array $raws = [])
    {
        Rabbit::start(function () use ($namespace, $raws) {
            Rabbit::publish([
                'appid' => $this->appid,
                'namespace' => $namespace,
                'raws' => $raws,
            ], [
                'exchange' => $this->exchange,
            ]);
        }, [
            'virualhost' => '/'
        ]);
    }
}
