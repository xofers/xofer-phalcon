<?php

/**
 * @description :微信远程通信控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace App\Wechat\Controllers;

use Dc\Lib\Traits\Wechat;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use Phalcon\Mvc\Controller;

class ServerController extends Controller
{

    use Wechat;

    /**
     * 服务端验证
     *
     * @throws \EasyWeChat\Core\Exceptions\InvalidArgumentException
     */
    public function indexAction()
    {
        $this->wechat->server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'text':
                    # 文字消息...
                    return $this->TextReplay($message);
                    break;
                case 'image':
                    # 图片消息...
                case 'voice':
                    # 语音消息...
                case 'video':
                    # 视频消息...
                case 'location':
                    # 坐标消息...
                case 'link':
                    # 链接消息...
                case 'event':
                    switch (strtolower($message->Event)) {
                        case 'click':
                            return $this->clickEvent($message);
                            break;
                        case 'subscribe':
                        default:
                            return $this->defaultReplay($message);
                            break;
                    }
                default:
                    return $this->defaultReplay($message);
                    break;
            }
        });

        $this->wechat->server->serve()->send();
    }

    /**
     * 点击事件
     *
     * @param object $message
     *
     * @return string
     */
    public function clickEvent($message)
    {
        switch ($message->EventKey) {
            case "wx_anli":
                $list = [
                    [
                        'title' => '目睹施工全过程，真实可靠',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=4&sn=ce4a73febfe884aec1ceee560ad7a35a#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-WBGAZKqtAAFluG39tSE491.jpg'
                    ],
                    [
                        'title' => '怎么花最少的钱提升出租屋的格调？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=4&sn=5518922dcfc75cc40fe446432f1e844d#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OoSAMeRbAAAPCwo4J9k035.jpg'
                    ],
                    [
                        'title' => '新年换新家，看看贵阳小媳妇们是怎么做的？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401789131&idx=3&sn=b6c8a58dcf1829e9ebd76aa24c03e78d#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OsSAYmdqAAAKZS1iE7o437.jpg'
                    ],
                    [
                        'title' => '四合院与居民小区的吊顶换新',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=6&sn=9568a43dd19893a198e9ab4fad8d355e#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OuKACEr0AAAPOzpXpOQ948.jpg'
                    ]
                ];
                return array_map(function ($value) {
                    return new News($value);
                }, $list);
                break;

            case "wx_red":
                $list = [
                    [
                        'title' => '你的现金红包到了，点击领取',
                        'url' => 'http://duocai.cn/m/wxmp/red',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0A/wKgBBFcfS1KAaFY0AAP-u-Y8Gr8622.jpg'
                    ]
                ];

                return array_map(function ($value) {
                    return new News($value);
                }, $list);
                break;
            case "wx_huanxin":
                $list = [
                    [
                        'title' => '换新视频如何挑选好吊顶？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403557097&idx=2&sn=23655588d2001f5338fa0e4bcfd23ecd#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-VymAbQIDAAMFYyyiUeg422.jpg',
                    ],
                    [
                        'title' => '撕壁纸、贴壁纸都大有学问，看专业人士是如何做的？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403630109&idx=3&sn=b89b3ebc9fed2214043b0fca1382e260#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PCGAdBJUAAAP7gPaHmk256.jpg'
                    ],
                    [
                        'title' => '如何让家里花小钱大变样？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=5&sn=9607ea7edcb63ee43bf8cda085a76218#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PEeAT7OcAAAQDkUWYDc255.jpg'
                    ],
                    [
                        'title' => '墙面发黑怎么办？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403345148&idx=2&sn=84a01be149684e211d41a168a0387652#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PGOAbs1AAAAKNZUyhmU754.jpg'
                    ],
                    [
                        'title' => '这么贴壁纸，一万年不翘边',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403307422&idx=4&sn=57ee5e1453267bc4239233d34c91ea36#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PIKAa7KWAAANZ88iL_0773.jpg',
                    ],
                    [
                        'title' => '墙面结构性裂缝怎么办？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402397477&idx=3&sn=0327aec4fa93e530f01b7ec0ec06238a#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PJ2AMyRoAAAPq0lJMUI941.jpg'
                    ],
                    [
                        'title' => '集成吊顶怎么安装？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=5&sn=ba623f9c1cc5069847a027a694f25b47#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PNOAArxMAAAVvdV6JCM354.jpg'
                    ],
                    [
                        'title' => '墙面发霉怎么快速轻松处理？',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402072036&idx=6&sn=d9fa56f4073d01ebfe9e237f1b71d17f#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PPWAVLR9AAANoRKBnGY205.jpg',
                    ],
                    [
                        'title' => '看看日本人的卫生间，你家的叫“水房”！',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=3&sn=1bd2873a060e86be99fbe710847fa9e4#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PQyASCJIAAASdRDBr-k861.jpg'
                    ]
                ];
                return array_map(function ($value) {
                    return new News($value);
                }, $list);
                break;

            case "wx_huodong":
                $list = [
                    [
                        'title' => '领红包|天天领现金红包，天天好运气!',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403947254&idx=1&sn=46ed729c1cf9269098423aa1d36080c4#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/03/wKgBBFcLf0GAWAceAAJkCZ2aYTE360.png'
                    ],
                    [
                        'title' => '送爱奇艺VIP会员',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403747588&idx=1&sn=13e95995e0c45c33e062f8fb385949ba#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PnGATJcSAAAR4JX71Ow196.jpg'
                    ],
                    [
                        'title' => '送《荒野猎人》电影票',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403630109&idx=1&sn=c3a30d1835263216365ad930590ead45#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PoaAUeIzAAAUEUw05Qk258.jpg',
                    ],
                    [
                        'title' => '女神节7.2折优惠重磅来袭，连续两天',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=1&sn=4ebc6d0c55ba61d348592444f1d886bf#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PqCAW3YuAAASBYrXOyw544.jpg'
                    ],
                    [
                        'title' => '3月换新季】0元预约，送千元装修礼包',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403336566&idx=1&sn=777fafcbd47853a371195caa8c58fe37#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PryAUKm-AAAc5iodl4E719.jpg'
                    ],
                    [
                        'title' => '399元一站换新家最后50单名额速来抢',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401753296&idx=1&sn=de9153fcec4db3cbed9cff4bf067b53b#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PtOABJi4AAAhk4mcMuo869.jpg'
                    ],
                    [
                        'title' => '2016新年大礼到，多种福利大放送',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=2&sn=fc56550eb6401de7bf340e3f5ca298eb#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PuyANaK6AAAXM_zejw4930.jpg'
                    ],
                    [
                        'title' => '899元辞旧迎新家',
                        'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=1&sn=64055fb8dec98425d806d392d98ed304#rd',
                        'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PwSAWaQVAAAjW0X5Who983.jpg'
                    ]
                ];
                return array_map(function ($value) {
                    return new News($value);
                }, $list);
                break;

            case "wx_phone":
                return new Text(['content' => '400-0263-626']);
                break;

            default:
                return $this->defaultReplay($message);
                break;
        }
    }

    /**
     * 默认回复
     *
     * @param object $message
     *
     * @return array
     */
    public function defaultReplay($message)
    {
        $list = [
            [
                'title' => $this->wechat->user->get($message->FromUserName)->nickname . '，你的现金红包到了，点击领取',
                'url' => 'http://duocai.cn/m/wxmp/red',
                'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0A/wKgBBFcfS1KAaFY0AAP-u-Y8Gr8622.jpg'
            ],
            [
                'title' => '【活动】深圳、苏州、南京、重庆新店大庆低至7折',
                'url' => 'http://duocai.cn/m/order/acti?campaignId=29',
                'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSTmASzXIAAM7BqOdUbk245.png'
            ],
            [
                'title' => '都说《欢乐颂》道具讲究，看了他们的家居道具后彻底服了',
                'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=2651683205&idx=1&sn=b28d09ba7a7c490bc7b633aa4a909c49#rd',
                'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSZaAczLPAALyt1Vv51w484.png'
            ],
            [
                'title' => '你是情绪型消费，还是理智型消费？',
                'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403935737&idx=1&sn=e9cce436b680057e7ea47ccd4da89cd2#rd',
                'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSb-ADPapAAFg4ZTDqTg940.png'
            ],
            [
                'title' => '家居装饰中，什么颜色适合搭配？',
                'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403557097&idx=1&sn=02e4820c4ecd3eda5da6ba3d76052a63#rd',
                'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSg-AXXpRAARfxZczVfE762.png'
            ]
        ];

        return array_map(function ($value) {
            return new News($value);
        }, $list);
    }

    /**
     * 文字回复
     *
     * @param object $message
     *
     * @return object
     */
    public function TextReplay($message)
    {
        //带链接的普通回复
        $reply[1] = [
            'title' => '测试丨一张图看穿你的潜在性格，准到爆！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400638117&idx=1&sn=cd2f760b83d8922b669a53576e045964#rd'
        ];
        $reply[2] = [
            'title' => '日本疯传的性格测试 | 五只猴子，你喜欢哪只？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400638408&idx=1&sn=a5ffa74e7f68b12238f7d4f6ffcf67b2#rd'
        ];
        $reply[3] = [
            'title' => '考考你的观察力丨一共多少人？（至少看三遍才有可能做对！）',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400787730&idx=1&sn=186082d284772f2a5bfb0fa91c5d3a40#rd'
        ];
        $reply[4] = [
            'title' => '一道超简单逻辑思维题，快来动动你的大脑！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400787997&idx=1&sn=bcbd89f22911da0d551633f01de853e3#rd'
        ];
        $reply[5] = [
            'title' => '超准测试 | 从花朵看个性，为你提出真诚建议！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400788129&idx=1&sn=8826378efea6666da3f1c7d79d85d4b6#rd'
        ];
        $reply[6] = [
            'title' => '测试隐藏人格丨当电话、短信、QQ、微信都有未读数，你会先看哪个?',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400895633&idx=1&sn=59bdb67149167ac9efdcfad9ed19b9c3#rd'
        ];
        $reply[7] = [
            'title' => '心理测试丨五把椅子你坐哪儿？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400895725&idx=1&sn=0f6401426af5b39b74dae2edf787f98e#rd'
        ];
        $reply[8] = [
            'title' => '测一测丨你喜欢什么样的男人？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009574&idx=1&sn=e5f6486910773e5d16f26bf2579e4b53#rd'
        ];
        $reply[9] = [
            'title' => '超灵的脾气性格测试丨你第一眼看到哪处不同？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009623&idx=1&sn=3dbeb376de33067fa7a472710a837f80#rd'
        ];
        $reply[10] = [
            'title' => '测试丨你是否拥有有非凡的处事能力？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009669&idx=1&sn=ee5b11ca49a6fdf5ca8f0d8426eff44b#rd'
        ];
        $reply[11] = [
            'title' => '情感测试：你对爱情的忠诚度有多高？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109014&idx=1&sn=2d5d5c0f9bf47e9d31afb99ef8e0a637#rd'
        ];
        $reply[12] = [
            'title' => '心理测试丨你是怎么拿手机的？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109091&idx=1&sn=48b0a6ee67cc6f59cbc9a6afe932255b#rd'
        ];
        $reply[13] = [
            'title' => '测试： 你最害怕的是什么？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109150&idx=1&sn=2668b3f9c4926f82fa77d2ecf71e5b08#rd'
        ];
        $reply[14] = [
            'title' => '侦探测试丨被杀害的作家？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412413&idx=1&sn=b10a1a6989a2565396e0055452f171a0#rd'
        ];
        $reply[15] = [
            '事业测试丨一张图片看出你是否能平步青云！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412471&idx=1&sn=b171de2bc259d419ce728ad150f27aa5#rd'
        ];
        $reply[16] = [
            'title' => '探测你的内心世界 | 九只眼睛你最喜欢哪一个？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412511&idx=1&sn=904d575b66ed2767579de9ab129e02d9#rd'
        ];
        $reply[17] = [
            'title' => '手相测试丨从指甲看性格，准到没了！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585191&idx=1&sn=02bbe0c588a8e31ceee44b5750ccd14d#rd'
        ];
        $reply[18] = [
            'title' => '你最先看到什么？一张图看穿你的个性与爱情',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585268&idx=1&sn=9e3b7717b48809252a58ee94871d91fc#rd'
        ];
        $reply[19] = [
            'title' => '测试：有多少人在暗恋你 ，你知道吗？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585339&idx=1&sn=4cb67ae3ae527299cc9e36b2eb852735#rd'
        ];
        $reply[20] = [
            'title' => '6种玫瑰颜色找出你的恋爱基因，亲测神准！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585419&idx=1&sn=df491b2999230ab4d5fee5285e878011#rd'
        ];
        $reply[21] = [
            'title' => '动动脑子，他们各姓什么？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306085&idx=1&sn=2507b34d2347863ab4b35941116d017c#rd'
        ];
        $reply[22] = [
            'title' => '测一测丨你最假的一面是什么？超准！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306142&idx=1&sn=6fd52afa11f31fb81d35359ed4aec44b#rd'
        ];
        $reply[23] = [
            'title' => '侦探测试丨《分歧的证言》，一道不可思议的推理难题',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306205&idx=1&sn=3948e301efd29d6c4f2b7be7daf5ca0c#rd'
        ];
        $reply[24] = [
            'title' => '测试丨事业与爱情，你会选择哪样？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306272&idx=1&sn=a57ad6e66aa0e0c3340f03837b4c83d3#rd'
        ];
        $reply[25] = [
            'title' => '性取向测试图，测完超级准！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306697&idx=1&sn=d20d7a5c533cd6edc66bcbbaf69d9d30#rd'
        ];
        $reply[26] = [
            'title' => '测试你的抗压能力：你会选哪个卫生间？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403114965&idx=1&sn=034274fa7cb2b11f687f873f457be8ef#rd'
        ];
        $reply[27] = [
            'title' => '准的可怕：测试你的易怒程度',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403114998&idx=1&sn=cbda9375cb7867420e371759759a02e2#rd'
        ];
        $reply[28] = [
            'title' => '测试丨神奇的哈佛大学测试题，透析人性',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403115066&idx=1&sn=c1c4bef95a0b5a69e220c659bcf350ef#rd'
        ];
        $reply['领福利'] = [
            'title' => '终于等到你！点击领取100元代金券和20M流量红包。',
            'href' => 'http://ceshi.aoyihutong.com:7890/hongbao/Views/views3.0/duocai-ddh.html'
        ];
        $reply['异性缘'] = [
            'title' => '测一测|在异性眼中你有多少存在感？',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400540572&idx=1&sn=319c80d42bb178ae877e1bf3e404c26e#rd'
        ];
        $reply['我单身'] = [
            'title' => '测一测|姑娘，你单身的原因！',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400541871&idx=1&sn=60e4b30cf17f3039037362e29444f408#rd'
        ];
        $reply['保洁券'] = [
            'title' => '58到家保洁券使用方法',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401936120&idx=1&sn=ced41a8196c0bbe64ef35a2dd8b82817#rd'
        ];
        $reply['人生'] = [
            'title' => '测一测：人生中你会最先舍弃的东西',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402305974&idx=1&sn=6296a535982380da4d371abc7badf5c6#rd'
        ];
        $reply['凶手'] = [
            'title' => '侦探测试丨按图索凶，看谁最快把凶手绳之以法',
            'href' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306112&idx=1&sn=6a544a9a7618390b1594a4cadbfead76#rd'
        ];

        //不带链接的普通回复
        $reply['上瘾'] = [
            'title' => '上瘾链接 https://yunpan.cn/cxXSaJKFGzWwu取码 4e61 如果资源被和谐，加小编微信xiaoyu-goodluck获取'
        ];

        $reply['a'] = [
            'title' => 'a型 你是属于水果香形象你充满自由愉悦的气息，总是沉溺左游乐场当中，像个天真无邪的孩子。有你在的地方，整个气氛都会兴奋起来，所以你是聚会中不可或缺的人物。虽说你个性开朗，受到大部份人的喜爱，但别人一般认为难以跟你成为亲密好友，即是说，你给人的印象只是个搞笑能手。有些人觉得你爱玩弄别人，依赖性又强，所以不太愿意亲近你。不过，真正的你其实十分成熟稳重，因为了解你的人不多，所以知己朋友也相当少。'
        ];

        $reply['b'] = [
            'title' => 'b型 你是属于东方花香形象你拥有强烈的自我意识，沉浸在自己的世界，会利用自己的力量积极地达成愿望，给人热情的印象。别人觉得你是独行侠，是个「带有神秘色彩的人物」。「神秘感」有时是相当有魅力的意思，但是你严密的防备以及自命清高的态度，让人无法轻松地与你对谈。甚而变成没有必要就不跟你接触，敬而远之。真正的你其实是相当温柔的，但是与你相当亲近的人，才注意到这一点。'
        ];

        $reply['c'] = [
            'title' => 'c型 你是属于草香形象你拥有非常坚强的意志，不依赖他人，喜欢独来独往。你拥有旺盛的好奇心与丰富的情绪，是个过着知性生活的现代人。第一眼印象你自命清高，不好相处，但进一步交谈后，就知道你很好相处，等到交情加深之后，就更知道你其实拥有很爽快的个性。你所拥有的中性化魅力，让你不论在男性团体或女性团体都大受欢迎，不过你不喜欢让人看到你脆弱的一面。你外表上看来也许很冷静，但实际上却是热情如火。'
        ];

        $reply['d'] = [
            'title' => 'd型 你是属于花香形象你总是给人乐观、积极、勇于面对困难的感觉，而且温柔优雅，很懂得为他人设想，善于维系人际关系。这样的你让人感到既坚强又脆弱，尤其是你那关怀体贴的包容力，更让人觉得你相当有魅力，很值得信赖。你长期给人认为你是个「拜託做事绝不会拒绝」的人，所以特别容易让依赖心强、只顾自己利益的人利用。这些人因为看中你细心随和的一面，所以会故意亲近你，然后藉故占你便宜。 要小心哦。'
        ];

        $reply['太阳的后裔'] = [
            'title' => '链接https://yunpan.cn/cxUN7iRQdr6Xp 访问密码 d93c'
        ];

        $reply['荒野猎人'] = [
            'title' => 'http://pan.baidu.com/s/1eRqXJpC 如果资源被和谐，加小编微信xiaoyu-goodluck获取'
        ];

        $reply['小测试1'] = [
            'title' => 'A.海边：对你来说，当生活中出现挫折或失败的时候，最好的安慰是爱情。所以，找到真心相爱的人，是你追求成功的同时必须要考虑的。B.山上：你是一个很乐观的人，相信再大的问题都会过去。对你来说，拥有一帮能够倾吐苦水的朋友是最重要的。C.草地上：你有些喜欢靠幻想来排解压力和焦虑。这样的排解可以顶一时之需，但从长远来看，你还需要自我成长锻炼自己应对现实和挫折的力量。D.屋顶：你通常喜欢把自己的生活安排的满满，让工作占据你的大多数时间，这样的你比较容易出现人际问题。所以，你最需要的，是扩大社交圈，融入集体之中。'
        ];

        $reply['小测试2'] = [
            'title' => 'A.照相机照相机是用来摄下影像的东西，你之所以会为它烦恼，表示你因无法掌握周遭的环境，而正为自己的未来烦恼着。凡是急欲知道自己未来的人，都会选择这个答案。B.大时钟正如时钟规律的滴滴答答计时声，你的身体每一部，也随着时间正确运作着。所以我们也因此能活下去。因此，可以将时钟看做是我们的内脏。选择这一项答案的人。可能表示你生病了，或者怀疑自己的健康状态出了问题。　　C.大皮箱皮箱是用来装东西的。这在潜意识中，代表着金钱；换句话说，丢弃大皮箱的人，表示很可能在金钱上正遭到问题。也许是收入不够；更可能是因为货款中的分期付款，正在困扰着你。D.灯灯代表厨房中的火，和房间中的照明。从灯中我们可以想像一家人，正快乐地生活着。选择此一答案的人，很可能正为家族或家庭的问题困扰着。有可能因而走向离婚一途。　　E.猪大肠刺身多条在食用前，必须要洗净，就像是脱掉身上的衣服，可以代表异性的情人。当然在打开之后，我们还是要食用它，所以也可以代表“性”，选择此一答案的你，表示正为异性问题困扰着。可能是双方正相隔两地，或者正在失恋当中。'
        ];

        $reply['聚划算'] = [
            'title' => '打开支付宝-红包，输入口令抢红包，口令为:换新家就找多彩换新'
        ];

        //回复带图片的信息
        $reply['扑克'] = [
            'title' => '你未来的另一半会是啥样？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403690850&idx=1&sn=0c29b240c864af953949fd453c57d183#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/wm_20160321134716.jpg'
        ];
        $reply['最爱'] = [
            'title' => '测试：算你一生会爱几个人？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403705615&idx=1&sn=7aa501437e87e42d0dccf3a88c118f08#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/wm_20160322095129.jpg'
        ];
        $reply['装潢'] = [
            'title' => '你能成为亿万富翁吗？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403723369&idx=1&sn=13eb3522a3b7386f754b6d7e5574fa14#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/viewfile.jpg'
        ];
        $reply['饮料'] = [
            'title' => '看看你是否错过了今生的缘分？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403745497&idx=1&sn=21151b23d1654e759c97cc84b0fa60a8#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_20160324154848.jpg'
        ];
        $reply['前世'] = [
            'title' => '测试：你前世是什么人？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403759017&idx=1&sn=9fe1f64f06265d2bb7991d0486908fd9#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/14/CqqLfVb0q52AB4nLAAGIxEHxulk703.jpg'
        ];
        $reply['暗恋'] = [
            'title' => '超准测试：有多少人在默默的喜欢着你（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403801343&idx=1&sn=b300fda2a4fc790f0a53ea3abde660e5#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_anlian.jpg'
        ];
        $reply['真实'] = [
            'title' => '在TA的心中你是一个什么样的人？【答案】',
            'url' => ' http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403801384&idx=1&sn=9db21f7e1c296e3b9be4334c4c66240d#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_zhenshi.jpg'
        ];
        $reply['人品'] = [
            'title' => '测试你身边的人有多喜欢你?(答案) ',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403801419&idx=1&sn=86ddf60d13f420396313d367d74ce4b8#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_renping.jpg'
        ];
        $reply['海豚'] = [
            'title' => '准爆了~一张图测试你的好色程度（男女通用）【答案】',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403801482&idx=1&sn=1fbc20c7dda22be087de967c6314329e#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_haitun.jpg'
        ];
        $reply['十年'] = [
            'title' => '你十年后会成为什么样？（答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403801027&idx=1&sn=3a0dd7d9c935c13d669140367725d7c6#rd',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/weixin/acti/vm_shinian.jpg'
        ];
        $reply['招商银行'] = [
            'title' => '招行员工全场享受8折优惠!',
            'url' => 'http://duocai.cn/m/wxmp/index?type=1',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/16/CqqLfVb-EiaAZNpTAADtaxZwXnw814.jpg'
        ];
        $reply['联想'] = [
            'title' => '联想员工全场享受8折优惠!',
            'url' => 'http://duocai.cn/m/wxmp/index?type=2',
            'picUrl' => 'http://img.res.duocai.cn/img/fe/fxicon.jpg'
        ];
        $reply['猴子'] = [
            'title' => '5只猴子选一只，瞬间看透你内心！（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403914112&idx=1&sn=f963291de8c57907ddd7a310092978f8#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/01/wKgBBFcDdbaAHbAJAAA05X5R5Zc029.jpg'
        ];
        $reply['坐姿'] = [
            'title' => '从坐姿看出你的性格（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403914953&idx=1&sn=3472aeb1cc744d8d9a8d584f8c19608b#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/01/wKgBBFcDdgKAGLaCAAAnpPxhHHQ146.jpg'
        ];
        $reply['办公室'] = [
            'title' => '你是情绪型消费，还是理智型消费？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403914981&idx=1&sn=01fd070695fa4b20c1445d6faa5a7fd5#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/01/wKgBBFcDdh6AYpOpAAASaq33SV8487.jpg'
        ];
        $reply['邪恶'] = [
            'title' => '测测你到底有多邪恶，你敢么？(答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403915001&idx=1&sn=8bb00e5250afb56f9dc262c8a87976d0#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/01/wKgBBFcDdjmAMNQKAAAZyqrX4mw647.jpg'
        ];
        $reply['反应'] = [
            'title' => '下意识伸手反应，测出你是哪种人！（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=404199348&idx=1&sn=c6f82bb8c45dcc3a7d1bb3bea280d3c5#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['刀片'] = [
            'title' => '测测你是《太阳的后裔》里的谁？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=404198960&idx=1&sn=a82c83cb4f29368cc5d9aed70ca753d1#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['执念'] = [
            'title' => '神准心测：你今生最该放下什么执念？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=404199183&idx=1&sn=713c3aa1212e4372e08f5ce529cb2299#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['情绪'] = [
            'title' => '一张图看你的情绪黑洞有多大？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=404199208&idx=1&sn=3845bb13d0d144703242f1e7616dbbab#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['变老'] = [
            'title' => '这个测试让你知道自己老了会变成什么样（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=404199246&idx=1&sn=e9d9780ad30df106c3b750effc8aebfb#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['命运'] = [
            'title' => ' 心理测试 | 你这一生有没有富贵命？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199349&idx=1&sn=a33736e6776eddc8e8562446b2420bc2#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['毒药'] = [
            'title' => '测职场啥事最烧你脑（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199351&idx=1&sn=ae317ff27990cd490324f2ce92524a48#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['滋润'] = [
            'title' => '测下看看你的生活滋润度怎么样（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199351&idx=1&sn=ae317ff27990cd490324f2ce92524a48#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['自画像'] = ['title' => '暴露人真实性格的测试！你敢测吗？(答案',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199352&idx=1&sn=545993774c12f3d8e9e8f61d4038b777#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['时辰'] = [
            'title' => '知道你的出生时间代表什么吗？(答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199353&idx=1&sn=c8107e46cc79fbfe88c432373b3c7803#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/04/wKgBBFcMvxKAIXfXAAAqkloIecM756.jpg'
        ];
        $reply['潜质'] = [
            'title' => '你的最强潜质是什么？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199423&idx=1&sn=bfddae67d255c2624d81042d866422cc#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/09/wKgBBFcd4VuAGlUKAALJmsF1P9A256.png'
        ];
        $reply['黑图'] = [
            'title' => '性格测试--看了这张图，你会联想到什么东西？(答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199425&idx=1&sn=4c8dc96668984ff3f6194eecab65882e#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/09/wKgBBFcd4cCAHUM8AAG0oKajXIY044.png'
        ];
        $reply['狮子'] = [
            'title' => '一眼看出你是什么类型，神准！（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199427&idx=1&sn=33c88b875f41ffae1a5ede75c86b8113#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/09/wKgBBFcd4gmANo1lAAIUhvf25q0521.png'
        ];
        $reply['压力'] = [
            'title' => '压力山大时你如何有效缓解？(答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199431&idx=1&sn=788510fbd1916cca68acd7c413378be1#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/09/wKgBBFcd4luAS_lKAACZUr2ps28191.png'
        ];
        $reply['穿衣'] = [
            'title' => '一秒看穿你的穿衣品味有几分？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199432&idx=1&sn=33a0dd00975dc48b53ed2fc6ae33de27#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/09/wKgBBFcd4rCAa6klAAFEmVMuEaI684.png'
        ];
        $reply['许愿池'] = [
            'title' => '你对异性的吸引力有几分？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199559&idx=1&sn=70d8af7de3391867df49f4c3286e023d#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0E/wKgBBFcocV-AQjQOAALbrJjwB6c526.png'
        ];
        $reply['欢乐颂'] = [
            'title' => '你是《欢乐颂》里的谁？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199561&idx=1&sn=01ffbdff6f0060b169873a06a973843f#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0E/wKgBBFcocfKAbuERAANT3zWbQk0204.png'
        ];
        $reply['数字'] = [
            'title' => '一张图看穿你的内心有多封闭！（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199562&idx=1&sn=7e084e086aad74f0f840828e51b967e3#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0E/wKgBBFcockCACR2eAAItSayigoU009.png'
        ];
        $reply['距离'] = [
            'title' => '你最不该和哪种异性在一起？（答案）',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199565&idx=1&sn=371300a31153c2d6390084395f4b2ebc#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0E/wKgBBFcocpqADpxbAAH8RoRJ8bI138.png'
        ];
        $reply['受欢迎'] = [
            'title' => '你受异性欢迎吗？神准！(答案)',
            'url' => 'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=504199567&idx=1&sn=bbeadbcf883ceb6e7ac2ddf2bc12903d#rd',
            'picUrl' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0E/wKgBBFcocr2AFG0rAAFt42gnqpo107.png'
        ];
        if (array_key_exists($message->Content, $reply)) {
            if (array_key_exists('href', $reply[$message->Content])) {
                return new Text(['content' => "<a href='{$reply[$message->Content]['href']}'>{$reply[$message->Content]['title']}</a>"]);
            }
            if (array_key_exists('picUrl', $reply[$message->Content])) {
                $reply[$message->Content]['image'] = $reply[$message->Content]['picUrl'];
                return new News($reply[$message->Content]);
            }
            return new Text(['content' => $reply[$message->Content]['title']]);
        }

        return $this->defaultReplay($message);
    }

    /**
     * 微信菜单
     *
     * @return object
     */
    public function wechatMenuAction()
    {
        $menus = [
            [
                "name" => "预约下单",
                "type" => "view",
                "url" => "http://duocai.cn/m/?style=wx",
                "sub_button" => [
                    [
                        "name" => "预约下单",
                        "type" => "view",
                        "url" => "http://duocai.cn/m/?style=wx"
                    ],
                    [
                        "name" => "订单查询",
                        "type" => "view",
                        "url" => "http://duocai.cn/m/ordercenter/login"
                    ],
                    [
                        "name" => "案例推荐",
                        "type" => "click",
                        "key" => "wx_anli"
                    ],
                    [
                        "name" => "换新视频",
                        "type" => "click",
                        "key" => "wx_huanxin"
                    ],
                ]
            ],
            [
                "name" => "本周福利",
                "type" => "view",
                "url" => "http://buluo.qq.com/buluoadmin/home.html#/allposts/282201",
                "sub_button" => [
                    [
                        "name" => "拼团享七折",
                        "type" => "view",
                        "url" => "http://duocai.cn/m/order/acti?campaignId=29"
                    ],
                    [
                        "name" => "今日福利",
                        "type" => "click",
                        "key" => "wx_red"
                    ],
                    [
                        "name" => "多彩部落",
                        "type" => "view",
                        "url" => "http://buluo.qq.com/p/barindex.html?bid=282201&from=share_wechat"
                    ],
                    [
                        "name" => "往期活动",
                        "type" => "click",
                        "key" => "wx_huodong"
                    ],
                ]
            ],
            [
                "name" => "关于多彩",
                "type" => "view",
                "url" => "http://m.vcooline.com/app/materials/196332?wxmuid=52677#mp.weixin.qq.com",
                "sub_button" => [
                    [
                        "name" => "门店查询",
                        "type" => "view",
                        "url" => "http://cc.duocai.cn/m/order/store?x=116.5208294561&y=39.79431078909&cityName=%E5%8C%97%E4%BA%AC"
                    ],
                    [
                        "name" => "客服电话",
                        "type" => "click",
                        "key" => "wx_phone"
                    ],
                    [
                        "name" => "商务合作",
                        "type" => "view",
                        "url" => "http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403868965&idx=1&sn=c184bd16c11d449f685d5233611ac2c8#rd"
                    ]
                ]
            ]
        ];

        $this->wechat->menu->add($menus);
    }

    /**
     * 处理口令红包领奖
     *
     * @param $message
     * @return array|News|Text
     */
    public function handleLuckMoney($message)
    {
        $source = explode('-', $message->Content);
        switch ($source[0]) {
            case "red":
                $res = \WxUserSource::findFirst([
                    "source = :source:",
                    'bind' => array('source' => $message->Content),
                ]);

                if (empty($res->openId)) {

                    $res = \WxUserSource::findFirst([
                        "source = :source:",
                        'bind' => array('source' => $message->Content),
                    ]);

                    if (empty($res)) {
                        break;
                    }

                    $res->openId = $message->FromUserName;
                    if ($res->save() !== false) {
                        return new Text(['content' => '恭喜您领取了红包，我们将会在明天统一发放！']);
                    }

                    return new Text(['content' => '红包领取失败，请重新输入口令！']);
                }
                break;
            case "Lottery":
                $res = \WxUserSource::findFirst([
                    "source = :source:",
                    'bind' => array('source' => $message->Content),
                ]);

                if (!empty(\WxUserSource::findFirst([
                    "openId = :openId: and status = 100",
                    'bind' => array('openId' => $message->FromUserName)
                ]))
                ) {
                    return $this->defaultReplay($message);
                }

                if (empty($res->openId)) {
                    $red = \WxUserSource::findFirst([
                        "source = :source:",
                        'bind' => array('source' => $message->Content),
                    ]);

                    $red->name = $this->wechat->user->get($message->FromUserName)->nickname;
                    $red->openId = $message->FromUserName;

                    if ($red->save() !== false) {
                        return new News([
                            'title' => '拍照赢千元现金,人人有红包哦~',
                            'url' => "http://duocai.cn/m/wxmp/lottery?source=" . $message->Content,
                            'image' => 'http://photo.res.ehuanxin.com/ehx/M00/00/0B/wKgBBFcjCtiAP625AAJk5YLlWms586.jpg'
                        ]);
                    }
                }
                return $this->defaultReplay($message);
        }
    }

    public function shareCampaignAction()
    {
        $userData = $this->authorize()->getOriginal();
        $uri = '';
        if (!empty($userData)) {
            $openIdSource = $this->request->get('openIdSource', 'string', '');

            if ($openIdSource != '') {
                $uri .= '&openIdSource=' . $openIdSource;
            }

            //查询是否已经参过团
            $wxUser = \WxUserSource::findFirst("openId = '{$userData['openid']}' and source ='微信拼团-WX' and delFlag = 0");
            if (empty($wxUser)) {
                //查询是否要参加别人的拼团
                $userSource = \WxUserSource::findFirst("openId = '{$openIdSource}' and source ='微信拼团-WX' and address = '' and delFlag = 0");

                $newUser = new \WxUserSource();
                $newUser->openId = $userData['openid'];
                $newUser->status = 1;
                $newUser->source = '微信拼团-WX';
                $newUser->createTime = date('Y-m-d H:i:s');
                $newUser->remark = json_encode(['nickname' => $userData['nickname'], 'headimgurl' => $userData['headimgurl']]);
                //参加已经有的拼团
                if (!empty($userSource)) {
                    $newUser->address = $userSource->openId;
                }

                if ($newUser->save() == false) {
                    die('出错了,请重试！');
                }
            }
            $uri .= '&uid=' . $userData['openid'];
        }

        $url = 'http://duocai.cn/m/order/acti?campaignId=29' . $uri;
        if (IS_DEV) {
            $url = 'http://dev.duocai.cn/m/order/acti?campaignId=29' . $uri;
        }
        $this->response->redirect($url, true);
        $this->view->disable();

    }
}
