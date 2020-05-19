<?php

namespace app\admin\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) 2020新春快乐</h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/><span style="font-size:30px;">14载初心不改 - 你值得信赖的PHP框架</span></p><span style="font-size:25px;">[ V6.0 版本由 <a href="https://www.yisu.com/" target="yisu">亿速云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }

    public function test()
    {
        $data = ['name' => 'thinkphp', 'status' => '1'];
        return json($data);
    }

    public function test2()
    {
        echo md5("qweq");
    }

    public function article()
    {
        $data = [
            'code' => 200,

            'message' => '',

            'result' => [
                [

                'id' => 1,

                'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/zOsKZmFRdUtvpqCImOVY.png",

                'owner' => "付小小",

                'content' => "段落示意：蚂蚁金服设计平台 ant.design，用最小的工作量，无缝接入蚂蚁金服生态，提供跨越设计与开发的体验解决方案。蚂蚁金服设计平台 ant.design，用最小的工作量，无缝接入蚂蚁金服生态，提供跨越设计与开发的体验解决方案。",

                'star' => 666,
                'percent' => 84,
                'like' => 21,
                'message' => 888,
                'description' => "在中台产品的研发过程中，会出现不同的设计规范和实现方式，但其中往往存在很多类似的页面和组件，这些类似的组件会被抽离成一套标准规范。",
                'href' => "https://ant.design",
                'title' => "Alipay",
                'updatedAt' => "2020-05-19",
                'members' => [
                    [
                        'avatar'=>"https://gw.alipayobjects.com/zos/rmsportal/ZiESqWwCXBRQoaPONSJe.png",
                        'name' => "曲丽丽",
                        'id' => "member1"
                    ],
                    [
                        'avatar'=>"https://gw.alipayobjects.com/zos/rmsportal/tBOxZPlITHqwlGjsJWaF.png",
                        'name' => "王昭君",
                        'id' => "member2"
                    ],
                    [
                        'avatar'=>"https://gw.alipayobjects.com/zos/rmsportal/sBxjgqiuHMGRkIjqlQCd.png",
                        'name' => "董娜娜",
                        'id' => "member3"
                    ]
                ],
                'activeUser' => 5145,
                'newUser' => 1201,
                'cover' => 3
            ]],

            'timestamp' => time()

        ];

        return json($data);
    }
}
