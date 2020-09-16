<?php
declare (strict_types = 1);

namespace app\middleware;

use think\facade\Cache;

class AuthTokenMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $token = $request->header('access-token');
        if($token){
            $admin = Cache::get($token);
            if(!$admin){
                return \think\Response::create()->code(401);
            }
        }else{
            return \think\Response::create()->code(401);
        }
        $request->admin = $admin;
        return $next($request);
    }
}
