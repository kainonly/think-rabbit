<?php

namespace think\logging;

use think\Facade;

/**
 * Class Logging
 * @package think\logging
 * @method static void push(string $namespace, array $data = []) 信息收集推送
 */
final class Logging extends Facade
{
    protected static function getFacadeClass()
    {
        return BitLogging::class;
    }
}
