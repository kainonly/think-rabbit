<?php

namespace think\amqp;

use think\Facade;

/**
 * Class Logging
 * @package think\logging
 * @method static void push($namespace, array $raws = []) 信息收集推送
 */
final class Logging extends Facade
{
    protected static function getFacadeClass()
    {
        return FactoryLogging::class;
    }
}
