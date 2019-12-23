<?php
declare (strict_types=1);

namespace think\amqp\service;

use think\amqp\common\AMQPFactory;
use think\amqp\contract\AMQPInterface;
use think\Service;

class AMQPService extends Service
{
    public function register()
    {
        $this->app->bind(AMQPInterface::class, function () {
            $config = $this->app->config
                ->get('queue.rabbitmq');

            return new AMQPFactory($config);
        });
    }
}