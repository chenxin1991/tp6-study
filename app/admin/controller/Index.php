<?php

namespace app\admin\controller;

use app\BaseController;

class Index extends BaseController
{

    public function article()
    {
        $data = [
            'code' => 404,

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
                            'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/ZiESqWwCXBRQoaPONSJe.png",
                            'name' => "曲丽丽",
                            'id' => "member1"
                        ],
                        [
                            'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/tBOxZPlITHqwlGjsJWaF.png",
                            'name' => "王昭君",
                            'id' => "member2"
                        ],
                        [
                            'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/sBxjgqiuHMGRkIjqlQCd.png",
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
