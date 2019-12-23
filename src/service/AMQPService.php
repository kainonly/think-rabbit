<?php

declare (strict_types=1);

namespace think\amqp\service;

use simplify\amqp\AMQPClient;
use think\Service;

final class AMQPService extends Service
{
    public function register()
    {
        $this->app->bind('amqp', function () {
            $config = $this->app->config
                ->get('queue.rabbitmq');
        });
    }
}