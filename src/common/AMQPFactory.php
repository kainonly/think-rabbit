<?php
declare (strict_types=1);

namespace think\amqp\common;

use Closure;
use Exception;
use InvalidArgumentException;
use simplify\amqp\AMQPClient;
use think\amqp\contract\AMQPInterface;

/**
 * AMQP 实例对象
 * Class AMQPFactory
 * @package think\amqp\common
 */
class AMQPFactory implements AMQPInterface
{
    /**
     * 配置集合
     * @var array
     */
    private $options = [];

    /**
     * AMQPInstance constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $name
     * @return AMQPClient
     * @inheritDoc
     */
    public function client(string $name): AMQPClient
    {
        if (empty($this->options[$name])) {
            throw new InvalidArgumentException("The [$name] does not exist.");
        }
        $option = $this->options[$name];
        if (empty($option['virualhost'])) {
            $option['virualhost'] = '/';
        }
        if (!isset($option['extra'])) {
            $option['extra'] = [];
        }
        return new AMQPClient(
            $option['hostname'],
            (int)$option['port'],
            $option['username'],
            $option['password'],
            $option['virualhost'],
            $option['extra']
        );
    }

    /**
     * @param Closure $closure
     * @param array $options
     * @throws Exception
     * @inheritDoc
     */
    public function channel(Closure $closure, array $options = []): void
    {
        $this->client('default')->channel($closure, $options);
    }

    /**
     * @param Closure $closure
     * @param array $options
     * @throws Exception
     * @inheritDoc
     */
    public function channeltx(Closure $closure, array $options = []): void
    {
        $this->client('default')->channeltx($closure, $options);
    }
}