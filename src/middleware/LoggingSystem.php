<?php

namespace think\logging\middleware;

use think\amqp\Logging;
use think\Request;

/**
 * 后台操作数据收集中间件
 * Class LoggingSystem
 * @package think\logging\middleware
 */
class LoggingSystem
{
    public function handle(Request $request, \Closure $next)
    {
        if ($this->excluded($request)) {
            return $next($request);
        }

        Logging::push('system', [
            'symbol' => $request->symbol,
            'url' => $request->url(),
            'method' => $request->method(),
            'param' => $request->post(),
            'ip' => $request->server('REMOTE_ADDR'),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'create_time' => time()
        ]);

        return $next($request);
    }

    /**
     * 排除条件
     * @param Request $request
     * @return bool
     */
    protected function excluded(Request $request)
    {
        return (
            strpos($request->action(), 'valided') !== false
        );
    }
}
