<?php

namespace think\logging;

use think\Facade;

/**
 * Class Queue
 * @package think\logging
 * @method static void push(string $namespace, array $data = []) 信息收集推送
 */
final class Queue extends Facade
{
    protected static function getFacadeClass()
    {
        return BitQueue::class;
    }
}
