<?php

/**
 * @description :微信远程通信控制器
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-28
 */

namespace Dc\Wechat\Controllers;

use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use EasyWeChat\Foundation\Application;
use Phalcon\Mvc\Controller;

class ServerController extends Controller {

    private $user;

    /**
     * 服务端验证
     *
     * @throws \EasyWeChat\Core\Exceptions\InvalidArgumentException
     */
    public function indexAction() {

        $wxApp = new Application($this->config->wechat->toArray());
        $this->user = $wxApp->user;

        $server = $wxApp->server;
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'text':
                    return $this->TextReplay($message);
                    # 文字消息...
                case 'image':
                    return $this->ImageReplay($message);
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
                    switch ($message->Event) {
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

        $server->serve()->send();
    }

    /**
     * 点击事件
     *
     * @param object $message
     *
     * @return string
     */
    public function clickEvent($message){
        $newsList = [];
        $news = new News();
        switch ($message->EventKey) {
            case "wx_anli":
                $news->title    =   '目睹施工全过程，真实可靠';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=4&sn=ce4a73febfe884aec1ceee560ad7a35a#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-WBGAZKqtAAFluG39tSE491.jpg';
                $newsList[]     =   $news;

                $news->title    =   '怎么花最少的钱提升出租屋的格调？';
                $news->url      =   '	http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=4&sn=5518922dcfc75cc40fe446432f1e844d#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OoSAMeRbAAAPCwo4J9k035.jpg';
                $newsList[]     =   $news;

                $news->title    =   '新年换新家，看看贵阳小媳妇们是怎么做的？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401789131&idx=3&sn=b6c8a58dcf1829e9ebd76aa24c03e78d#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OsSAYmdqAAAKZS1iE7o437.jpg';
                $newsList[]     =   $news;

                $news->title    =   '四合院与居民小区的吊顶换新';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=6&sn=9568a43dd19893a198e9ab4fad8d355e#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-OuKACEr0AAAPOzpXpOQ948.jpg';
                $newsList[]     =   $news;

                return $newsList;
                break;

            case "wx_red":
                $news->title    =   '你的现金红包到了，点击领取';
                $news->url      =   'http://duocai.cn/m/wxmp/red';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0A/wKgBBFcfS1KAaFY0AAP-u-Y8Gr8622.jpg';

                return $news;
                break;

            case "wx_huanxin":
                $news->title    =   '换新视频	如何挑选好吊顶？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403557097&idx=2&sn=23655588d2001f5338fa0e4bcfd23ecd#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-VymAbQIDAAMFYyyiUeg422.jpg';
                $newsList[]     =   $news;

                $news->title    =   '撕壁纸、贴壁纸都大有学问，看专业人士是如何做的？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403630109&idx=3&sn=b89b3ebc9fed2214043b0fca1382e260#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PCGAdBJUAAAP7gPaHmk256.jpg';
                $newsList[]     =   $news;

                $news->title    =   '如何让家里花小钱大变样？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=5&sn=9607ea7edcb63ee43bf8cda085a76218#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PEeAT7OcAAAQDkUWYDc255.jpg';
                $newsList[]     =   $news;

                $news->title    =   '墙面发黑怎么办？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403345148&idx=2&sn=84a01be149684e211d41a168a0387652#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PGOAbs1AAAAKNZUyhmU754.jpg';
                $newsList[]     =   $news;

                $news->title    =   '这么贴壁纸，一万年不翘边';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403307422&idx=4&sn=57ee5e1453267bc4239233d34c91ea36#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PIKAa7KWAAANZ88iL_0773.jpg';
                $newsList[]     =   $news;

                $news->title    =   '墙面结构性裂缝怎么办？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402397477&idx=3&sn=0327aec4fa93e530f01b7ec0ec06238a#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PJ2AMyRoAAAPq0lJMUI941.jpg';
                $newsList[]     =   $news;

                $news->title    =   '集成吊顶怎么安装？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402186726&idx=5&sn=ba623f9c1cc5069847a027a694f25b47#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PNOAArxMAAAVvdV6JCM354.jpg';
                $newsList[]     =   $news;

                $news->title    =   '墙面发霉怎么快速轻松处理？';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402072036&idx=6&sn=d9fa56f4073d01ebfe9e237f1b71d17f#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PPWAVLR9AAANoRKBnGY205.jpg';
                $newsList[]     =   $news;

                $news->title    =   '看看日本人的卫生间，你家的叫“水房”！';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=3&sn=1bd2873a060e86be99fbe710847fa9e4#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PQyASCJIAAASdRDBr-k861.jpg';
                $newsList[]     =   $news;

                return $newsList;
                break;

            case "wx_huodong":
                $news->title    =   '领红包|天天领现金红包，天天好运气!';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403947254&idx=1&sn=46ed729c1cf9269098423aa1d36080c4#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/03/wKgBBFcLf0GAWAceAAJkCZ2aYTE360.png';
                $newsList[]     =   $news;

                $news->title    =   '送爱奇艺VIP会员';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403747588&idx=1&sn=13e95995e0c45c33e062f8fb385949ba#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PnGATJcSAAAR4JX71Ow196.jpg';
                $newsList[]     =   $news;

                $news->title    =   '送《荒野猎人》电影票';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403630109&idx=1&sn=c3a30d1835263216365ad930590ead45#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PoaAUeIzAAAUEUw05Qk258.jpg';
                $newsList[]     =   $news;

                $news->title    =   '女神节7.2折优惠重磅来袭，连续两天';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403447300&idx=1&sn=4ebc6d0c55ba61d348592444f1d886bf#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PqCAW3YuAAASBYrXOyw544.jpg';
                $newsList[]     =   $news;

                $news->title    =   '【3月换新季】0元预约，送千元装修礼包';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403336566&idx=1&sn=777fafcbd47853a371195caa8c58fe37#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PryAUKm-AAAc5iodl4E719.jpg';
                $newsList[]     =   $news;

                $news->title    =   '399元一站换新家最后50单名额速来抢';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401753296&idx=1&sn=de9153fcec4db3cbed9cff4bf067b53b#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PtOABJi4AAAhk4mcMuo869.jpg';
                $newsList[]     =   $news;

                $news->title    =   '2016新年大礼到，多种福利大放送';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=2&sn=fc56550eb6401de7bf340e3f5ca298eb#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PuyANaK6AAAXM_zejw4930.jpg';
                $newsList[]     =   $news;

                $news->title    =   '899元辞旧迎新家';
                $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401922959&idx=1&sn=64055fb8dec98425d806d392d98ed304#rd';
                $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/00/wKgBBFb-PwSAWaQVAAAjW0X5Who983.jpg';
                $newsList[]     =   $news;

                return $newsList;
                break;

            case "wx_phone":
                return new Text(['content'=>'400-0263-626']);
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
    public function defaultReplay($message){
        $newsList = [];
        $news = new News();

        $news->title    =   $this->user->get($message->FromUserName)->nickname. '，你的现金红包到了，点击领取';
        $news->url      =   'http://duocai.cn/m/wxmp/red';
        $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0A/wKgBBFcfS1KAaFY0AAP-u-Y8Gr8622.jpg';
        $newsList[]     =   $news;

        $news->title    =   '【活动】深圳、苏州、南京、重庆新店大庆低至7折';
        $news->url      =   'http://duocai.cn/m/order/acti?campaignId=29';
        $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSTmASzXIAAM7BqOdUbk245.png';
        $newsList[]     =   $news;

        $news->title    =   '都说《欢乐颂》道具讲究，看了他们的家居道具后彻底服了';
        $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=2651683205&idx=1&sn=b28d09ba7a7c490bc7b633aa4a909c49#rd';
        $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSZaAczLPAALyt1Vv51w484.png';
        $newsList[]     =   $news;

        $news->title    =   '你是情绪型消费，还是理智型消费？';
        $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403935737&idx=1&sn=e9cce436b680057e7ea47ccd4da89cd2#rd';
        $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSb-ADPapAAFg4ZTDqTg940.png';
        $newsList[]     =   $news;

        $news->title    =   '家居装饰中，什么颜色适合搭配？';
        $news->url      =   'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403557097&idx=1&sn=02e4820c4ecd3eda5da6ba3d76052a63#rd';
        $news->image    =   'http://photo.res.ehuanxin.com/ehx/M00/00/0F/wKgBBFcpSg-AXXpRAARfxZczVfE762.png';
        $newsList[]     =   $news;

        return $newsList;
    }

    /**
     * 文字回复
     *
     * @param object $message
     *
     * @return object
     */
    public function TextReplay($message){
        $replay[1] = [
            '测试丨一张图看穿你的潜在性格，准到爆！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400638117&idx=1&sn=cd2f760b83d8922b669a53576e045964#rd'
        ];
        $replay[2] = [
            '日本疯传的性格测试 | 五只猴子，你喜欢哪只？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400638408&idx=1&sn=a5ffa74e7f68b12238f7d4f6ffcf67b2#rd'
        ];
        $replay[3] = [
            '考考你的观察力丨一共多少人？（至少看三遍才有可能做对！）',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400787730&idx=1&sn=186082d284772f2a5bfb0fa91c5d3a40#rd'
        ];
        $replay[4] = [
            '一道超简单逻辑思维题，快来动动你的大脑！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400787997&idx=1&sn=bcbd89f22911da0d551633f01de853e3#rd'
        ];
        $replay[5] = [
            '超准测试 | 从花朵看个性，为你提出真诚建议！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400788129&idx=1&sn=8826378efea6666da3f1c7d79d85d4b6#rd'
        ];
        $replay[6] = [
            '测试隐藏人格丨当电话、短信、QQ、微信都有未读数，你会先看哪个?',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400895633&idx=1&sn=59bdb67149167ac9efdcfad9ed19b9c3#rd'
        ];
        $replay[7] = [
            '心理测试丨五把椅子你坐哪儿？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400895725&idx=1&sn=0f6401426af5b39b74dae2edf787f98e#rd'
        ];
        $replay[8] = [
            '测一测丨你喜欢什么样的男人？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009574&idx=1&sn=e5f6486910773e5d16f26bf2579e4b53#rd'
        ];
        $replay[9] = [
            '超灵的脾气性格测试丨你第一眼看到哪处不同？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009623&idx=1&sn=3dbeb376de33067fa7a472710a837f80#rd'
        ];
        $replay[10] = [
            '测试丨你是否拥有有非凡的处事能力？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401009669&idx=1&sn=ee5b11ca49a6fdf5ca8f0d8426eff44b#rd'
        ];
        $replay[11] = [
            '情感测试：你对爱情的忠诚度有多高？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109014&idx=1&sn=2d5d5c0f9bf47e9d31afb99ef8e0a637#rd'
        ];
        $replay[12] = [
            '心理测试丨你是怎么拿手机的？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109091&idx=1&sn=48b0a6ee67cc6f59cbc9a6afe932255b#rd'
        ];
        $replay[13] = [
            '测试： 你最害怕的是什么？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401109150&idx=1&sn=2668b3f9c4926f82fa77d2ecf71e5b08#rd'
        ];
        $replay[14] = [
            '侦探测试丨被杀害的作家？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412413&idx=1&sn=b10a1a6989a2565396e0055452f171a0#rd'
        ];
        $replay[15] = [
            '事业测试丨一张图片看出你是否能平步青云！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412471&idx=1&sn=b171de2bc259d419ce728ad150f27aa5#rd'
        ];
        $replay[16] = [
            '探测你的内心世界 | 九只眼睛你最喜欢哪一个？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401412511&idx=1&sn=904d575b66ed2767579de9ab129e02d9#rd'
        ];
        $replay[17] = [
            '手相测试丨从指甲看性格，准到没了！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585191&idx=1&sn=02bbe0c588a8e31ceee44b5750ccd14d#rd'
        ];
        $replay[18] = [
            '你最先看到什么？一张图看穿你的个性与爱情',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585268&idx=1&sn=9e3b7717b48809252a58ee94871d91fc#rd'
        ];
        $replay[19] = [
            '测试：有多少人在暗恋你 ，你知道吗？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585339&idx=1&sn=4cb67ae3ae527299cc9e36b2eb852735#rd'
        ];
        $replay[20] = [
            '6种玫瑰颜色找出你的恋爱基因，亲测神准！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401585419&idx=1&sn=df491b2999230ab4d5fee5285e878011#rd'
        ];
        $replay[21] = [
            '动动脑子，他们各姓什么？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306085&idx=1&sn=2507b34d2347863ab4b35941116d017c#rd'
        ];
        $replay[22] = [
            '测一测丨你最假的一面是什么？超准！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306142&idx=1&sn=6fd52afa11f31fb81d35359ed4aec44b#rd'
        ];
        $replay[23] = [
            '侦探测试丨《分歧的证言》，一道不可思议的推理难题',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306205&idx=1&sn=3948e301efd29d6c4f2b7be7daf5ca0c#rd'
        ];
        $replay[24] = [
            '测试丨事业与爱情，你会选择哪样？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306272&idx=1&sn=a57ad6e66aa0e0c3340f03837b4c83d3#rd'
        ];
        $replay[25] = [
            '性取向测试图，测完超级准！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306697&idx=1&sn=d20d7a5c533cd6edc66bcbbaf69d9d30#rd'
        ];
        $replay[26] = [
            '测试你的抗压能力：你会选哪个卫生间？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403114965&idx=1&sn=034274fa7cb2b11f687f873f457be8ef#rd'
        ];
        $replay[27] = [
            '准的可怕：测试你的易怒程度',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403114998&idx=1&sn=cbda9375cb7867420e371759759a02e2#rd'
        ];
        $replay[28] = [
            '测试丨神奇的哈佛大学测试题，透析人性',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=403115066&idx=1&sn=c1c4bef95a0b5a69e220c659bcf350ef#rd'
        ];
        $replay['领福利'] = [
            '终于等到你！点击领取100元代金券和20M流量红包。',
            'http://ceshi.aoyihutong.com:7890/hongbao/Views/views3.0/duocai-ddh.html'
        ];
        $replay['异性缘'] = [
            '测一测|在异性眼中你有多少存在感？',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400540572&idx=1&sn=319c80d42bb178ae877e1bf3e404c26e#rd'
        ];
        $replay['我单身'] = [
            '测一测|姑娘，你单身的原因！',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=400541871&idx=1&sn=60e4b30cf17f3039037362e29444f408#rd'
        ];
        $replay['保洁券'] = [
            '58到家保洁券使用方法',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=401936120&idx=1&sn=ced41a8196c0bbe64ef35a2dd8b82817#rd'
        ];
        $replay['领奖'] = [
            '感谢您参与多彩换新的活动，小编会尽快与您联系发放奖品哟！'
        ];
        $replay['人生'] = [
            '测一测：人生中你会最先舍弃的东西',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402305974&idx=1&sn=6296a535982380da4d371abc7badf5c6#rd'
        ];
        $replay['凶手'] = [
            '侦探测试丨按图索凶，看谁最快把凶手绳之以法',
            'http://mp.weixin.qq.com/s?__biz=MzA4OTQzMDYwOQ==&mid=402306112&idx=1&sn=6a544a9a7618390b1594a4cadbfead76#rd'
        ];

        $replay['上瘾'] = [
            '上瘾链接 https://yunpan.cn/cxXSaJKFGzWwu取码 4e61 如果资源被和谐，加小编微信xiaoyu-goodluck获取'
        ];

        $replay['a'] = [
            'a型 你是属于水果香形象你充满自由愉悦的气息，总是沉溺左游乐场当中，像个天真无邪的孩子。有你在的地方，整个气氛都会兴奋起来，所以你是聚会中不可或缺的人物。虽说你个性开朗，受到大部份人的喜爱，但别人一般认为难以跟你成为亲密好友，即是说，你给人的印象只是个搞笑能手。有些人觉得你爱玩弄别人，依赖性又强，所以不太愿意亲近你。不过，真正的你其实十分成熟稳重，因为了解你的人不多，所以知己朋友也相当少。'
        ];

        $replay['b'] = [
            'b型 你是属于东方花香形象你拥有强烈的自我意识，沉浸在自己的世界，会利用自己的力量积极地达成愿望，给人热情的印象。别人觉得你是独行侠，是个「带有神秘色彩的人物」。「神秘感」有时是相当有魅力的意思，但是你严密的防备以及自命清高的态度，让人无法轻松地与你对谈。甚而变成没有必要就不跟你接触，敬而远之。真正的你其实是相当温柔的，但是与你相当亲近的人，才注意到这一点。'
        ];

        $replay['c'] = [
            'c型 你是属于草香形象你拥有非常坚强的意志，不依赖他人，喜欢独来独往。你拥有旺盛的好奇心与丰富的情绪，是个过着知性生活的现代人。第一眼印象你自命清高，不好相处，但进一步交谈后，就知道你很好相处，等到交情加深之后，就更知道你其实拥有很爽快的个性。你所拥有的中性化魅力，让你不论在男性团体或女性团体都大受欢迎，不过你不喜欢让人看到你脆弱的一面。你外表上看来也许很冷静，但实际上却是热情如火。'
        ];

        $replay['d'] = [
            'd型 你是属于花香形象你总是给人乐观、积极、勇于面对困难的感觉，而且温柔优雅，很懂得为他人设想，善于维系人际关系。这样的你让人感到既坚强又脆弱，尤其是你那关怀体贴的包容力，更让人觉得你相当有魅力，很值得信赖。你长期给人认为你是个「拜託做事绝不会拒绝」的人，所以特别容易让依赖心强、只顾自己利益的人利用。这些人因为看中你细心随和的一面，所以会故意亲近你，然后藉故占你便宜。 要小心哦。'
        ];

        $replay['太阳的后裔'] = [
            '链接https://yunpan.cn/cxUN7iRQdr6Xp 访问密码 d93c'
        ];

        $replay['荒野猎人'] = [
            'http://pan.baidu.com/s/1eRqXJpC 如果资源被和谐，加小编微信xiaoyu-goodluck获取'
        ];

        $replay['小测试1'] = [
            'A.海边：对你来说，当生活中出现挫折或失败的时候，最好的安慰是爱情。所以，找到真心相爱的人，是你追求成功的同时必须要考虑的。B.山上：你是一个很乐观的人，相信再大的问题都会过去。对你来说，拥有一帮能够倾吐苦水的朋友是最重要的。C.草地上：你有些喜欢靠幻想来排解压力和焦虑。这样的排解可以顶一时之需，但从长远来看，你还需要自我成长锻炼自己应对现实和挫折的力量。D.屋顶：你通常喜欢把自己的生活安排的满满，让工作占据你的大多数时间，这样的你比较容易出现人际问题。所以，你最需要的，是扩大社交圈，融入集体之中。'
        ];

        $replay['小测试2'] = [
            'A.照相机照相机是用来摄下影像的东西，你之所以会为它烦恼，表示你因无法掌握周遭的环境，而正为自己的未来烦恼着。凡是急欲知道自己未来的人，都会选择这个答案。B.大时钟正如时钟规律的滴滴答答计时声，你的身体每一部，也随着时间正确运作着。所以我们也因此能活下去。因此，可以将时钟看做是我们的内脏。选择这一项答案的人。可能表示你生病了，或者怀疑自己的健康状态出了问题。　　C.大皮箱皮箱是用来装东西的。这在潜意识中，代表着金钱；换句话说，丢弃大皮箱的人，表示很可能在金钱上正遭到问题。也许是收入不够；更可能是因为货款中的分期付款，正在困扰着你。D.灯灯代表厨房中的火，和房间中的照明。从灯中我们可以想像一家人，正快乐地生活着。选择此一答案的人，很可能正为家族或家庭的问题困扰着。有可能因而走向离婚一途。　　E.猪大肠刺身多条在食用前，必须要洗净，就像是脱掉身上的衣服，可以代表异性的情人。当然在打开之后，我们还是要食用它，所以也可以代表“性”，选择此一答案的你，表示正为异性问题困扰着。可能是双方正相隔两地，或者正在失恋当中。'
        ];

        //带链接的普通消息
        if (count($replay[$message->content]) == 2) {
            return new Text(['content'=>"<a href='{$replay[$message->content][1]}'>{$replay[$message->content][0]}</a>"]);
        }

        return new Text(['content'=>$replay[$message->content][0]]);
    }

    /**
     * 图片回复
     *
     * @param object $message
     *
     * @return object
     */
    public function ImageReplay($message){

    }
}