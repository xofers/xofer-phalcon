<?php
/**
 *
 * @description :微信Trait
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/5/9 0009 17:49
 *
 */
namespace Dc\Lib\Traits;

trait WechatTrait{

    /**
     * 微信授权获取用户信息
     *
     * @param string $redirect
     * @param string $scopes
     *
     * @return mixed
     */
    public function authorize($redirect = '',$scopes = 'snsapi_userinfo')
    {
        if ($this->request->has('state') && $this->request->has('code')) {
            return $this->wechat->oauth->user();
        }

        $redirect = empty($redirect)?$this->request->getScheme().'://' . $this->request->getHttpHost() . $this->request->getURI():$redirect;
        $scopes = is_string($scopes)?array_map('trim', explode(',', $scopes)):$scopes;

        $this->wechat->oauth->scopes($scopes)->redirect($redirect)->send();
        exit();
    }
}