<?php

namespace think\logging\middleware;

use think\logging\Logging;
use think\Request;

/**
 * Class SystemLog
 * @package think\logging\middleware
 */
class SystemLog
{
    public function handle(Request $request, \Closure $next)
    {
        if (strpos($request->action(), 'valided') !== false) return $next($request);
        Logging::push('system', [
            'user' => $request->user,
            'role' => $request->role,
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
}
