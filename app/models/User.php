<?php

namespace app\models;

use think\Model;
use app\common\library\wechat\WxUser;
use think\facade\Cache;

/**
 * 用户模型类
 * Class User
 * @package app\api\model
 */
class User extends Model
{
    private $token;

    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
        'update_time'
    ];

    /**
     * 获取用户信息
     * @param $token
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function getUser($token)
    {
        return self::where(['open_id' => Cache::get($token)['openid']])->find();
    }

    /**
     * 用户登录
     * @param array $post
     * @return string
     * @throws BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login($post)
    {
        // 微信登录 获取session_key
        $session = $this->wxlogin($post['code']);
        // 自动注册用户
        $userInfo = json_decode(htmlspecialchars_decode($post['user_info']), true);
        $user_id = $this->register($post['wxapp_id'], $session['openid'], $userInfo);
        // 生成token (session3rd)
        $this->token = $this->token($post['wxapp_id'], $session['openid']);
        // 记录缓存, 7天
        Cache::set($this->token, $session, 86400 * 7);
        return $user_id;
    }


    /**
     * 获取token
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * 微信登录
     * @param $code
     * @return array|mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function wxlogin($code)
    {
        // 微信登录 (获取session_key)
        $WxUser = new WxUser('wxfeb7e646e470417e', '383ee0da97f5db794b4791e516f5cc4f');
        if (!$session = $WxUser->sessionKey($code)) {
            throw new BaseException(['msg' => $WxUser->getError()]);
        }
        return $session;
    }

    /**
     * 生成用户认证的token
     * @param $openid
     * @return string
     */
    private function token($wxapp_id, $openid)
    {
        // 生成一个不会重复的随机字符串
        $guid = \getGuidV4();
        // 当前时间戳 (精确到毫秒)
        $timeStamp = microtime(true);
        // 自定义一个盐
        $salt = 'token_salt';
        return md5("{$wxapp_id}_{$timeStamp}_{$openid}_{$guid}_{$salt}");
    }

    /**
     * 自动注册用户
     * @param $open_id
     * @param $userInfo
     * @return mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function register($wxapp_id, $open_id, $userInfo)
    {
        if (!$user = self::where(['open_id' => $open_id])->find()) {
            $user = $this;
            $userInfo['open_id'] = $open_id;
            $userInfo['wxapp_id'] = $wxapp_id;
        }
        $userInfo['nickName'] = preg_replace('/[\xf0-\xf7].{3}/', '', $userInfo['nickName']);
        if (!$user->save($userInfo)) {
            throw new BaseException(['msg' => '用户注册失败']);
        }
        return $user['user_id'];
    }

}
