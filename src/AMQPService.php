<?php
declare (strict_types=1);

namespace think\amqp;

use think\Service;

class AMQPService extends Service
{
    public function register(): void
    {
        $this->app->bind(AMQPInterface::class, function () {
            $config = $this->app->config->get('queue.rabbitmq');
            return new AMQPFactory($config);
        });
    }
}