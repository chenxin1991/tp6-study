<?php
declare (strict_types = 1);

namespace app\middleware;

use app\models\User as UserModel;

class WechatMiddleware
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
        if (!$token = $request->param('token')) {
            return  json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }
        if (!$user = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        $request->user = $user;
        return $next($request);
    }
}