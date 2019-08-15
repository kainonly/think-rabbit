<?php

declare (strict_types=1);

namespace think\amqp\service;

use think\Service;
use tidy\amqp\RabbitClient;

final class AMQPService extends Service
{
    public function register()
    {
        $this->app->bind('amqp', function () {
            $config = $this->app->config
                ->get('queue.rabbitmq');

            return new RabbitClient($config);
        });
    }
}