<?php

namespace think\amqp\facade;

use Closure;
use think\Facade;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use tidy\amqp\common\Consumer;
use tidy\amqp\common\Exchange;
use tidy\amqp\common\Queue;

/**
 * Class AMQP
 * @method static void channel(Closure $closure, array $config = [])
 * @method static AMQPChannel getChannel()
 * @method static AMQPMessage message($text = '', array $config = [])
 * @method static void publish($text = '', array $config = [])
 * @method static void ack(string $delivery_tag, bool $multiple = false)
 * @method static void reject(string $delivery_tag, bool $requeue = false)
 * @method static void nack(string $delivery_tag, bool $multiple = false, bool $requeue = false)
 * @method static mixed revover(bool $requeue = false)
 * @method static Exchange exchange(string $exchangeName)
 * @method static Queue queue(string $queueName)
 * @method static Consumer consumer(string $consumerName)
 * @package think\amqp\facade
 */
final class AMQP extends Facade
{
    protected static function getFacadeClass()
    {
        return 'amqp';
    }
}