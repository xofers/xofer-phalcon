<?php

/**
 *
 * @description :微信公众号服务
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/20 0020 1:30
 *
 */
namespace Dc\Modules\Services;


use EasyWeChat\Foundation\Application;
use Doctrine\Common\Cache\PredisCache;

class Wechat extends Application
{
    public function __construct($config = null, $cache = null)
    {
        parent::__construct($config->wechat->toArray());

        //设置微信缓存
        $this->cache = new PredisCache($cache);
    }
}