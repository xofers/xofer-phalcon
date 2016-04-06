<?php

/**
 * @description :短信发送、邮件发送类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-3-29
 */

namespace Dc\Library;

use Phalcon\Di;

class Sms {

    /**
     * 业务标识
     *
     * @var String
     */
    public static $_OperID        = 'dcsj';

    /**
     * 操作密码
     *
     * @var String
     */
    public static $_OperPass      = 'bK$HCaNoIj*^unlW';

    /**
     * 发送时间
     *
     * @var String
     */
    public static $_SendTime      = '';

    /**
     * 消息存活有效期
     *
     * @var String
     */
    public static $_ValidTime     = '';

    /**
     * 附加号码
     *
     * @var String
     */
    public static $_AppendID      = '';

    /**
     * 接收手机号集合
     *
     * @var String 多个手机号用,来连接
     */
    public static $_DesMobile     = '';

    /**
     * 发送消息内容
     *
     * @var String
     */
    public static $_Content       = '';

    /**
     * 消息类型
     *
     * @var String
     */
    public static $_ContentType   = '8';

    /**
     * 短信接口地址
     *
     * @var String
     */
    public static $_Url           = 'http://221.179.180.158:9007/QxtSms/QxtFirewall';

    /**
     * 短信余额查询地址
     *
     * @var String
     */
    public static $_Surplus       = 'http://221.179.180.158:8081/QxtSms_surplus/surplus';


    /**
     * 发送短信
     *
     * @param string $DesMobile 手机号 多个手机号用逗号分割
     * @param string $Content 短信内容
     * @param string $SendTime 发送时间 格式：YmdHis
     * @param string $ValidTime 消息存活有效期 格式：YmdHis
     * @return array 其中 msgid 短信id
     *
     *   code 短信提交状态
     *   01	批量短信提交成功
     *   02	IP限制
     *   03	单条短信提交成功
     *   04	用户名错误
     *   05	密码错误
     *   07	发送时间错误
     *   08	信息内容为黑内容
     *   09	该用户的该内容 受同天内，内容不能重复发 限制
     *   10	扩展号错误
     *   97	短信参数有误
     *   11	余额不足
     *   -1	程序异常
     *   -101   手机号不能为空
     *   -102   短信内容不能为空
     */
    public static function send($DesMobile, $Content, $SendTime = '', $ValidTime = '') {
        if (empty($DesMobile)) {
            return array('code' => -101, 'message' => '手机号不能为空');
        } elseif (empty($Content)) {
            return array('code' => -102, 'message' => '短信内容不能为空');
        }

        $data = array_filter(array(
            'OperID'            => self::$_OperID,
            'OperPass'          => self::$_OperPass,
            'SendTime'          => !empty($SendTime) ? $SendTime : date('YmdHis'),
            'ValidTime'         => !empty($ValidTime) ? $ValidTime : date('YmdHis', time() + 600),
            'AppendID'          => self::$_AppendID,
            'DesMobile'         => $DesMobile,
            'Content'           => mb_convert_encoding($Content, "GBK", "UTF-8"),
            'ContentType'       => self::$_ContentType
        ));
        $data = http_build_query($data);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $data,
                'timeout' => 15 * 60
            )
        );
        $context = stream_context_create($options);

        $result = file_get_contents(self::$_Url, false, $context);
        $result =json_decode(json_encode((array) simplexml_load_string($result)), true);
        
        return $result;
    }

    /**
     * 查询余额
     * @return int 返回余额
     */
    public static function surplus(){
        return file_get_contents(self::$_Surplus.'?OperID='.self::$_OperID.'&OperPass='.self::$_OperPass);
    }

    public static function sendMail($subject = '', $body = '', $emails = array(), $attachment = '') {
        $mail =new \PHPMailer();
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->SMTPSecure = "ssl";

        $mail->Host = 'smtp.exmail.qq.com';
        $mail->Username = 'dev@duocai.cn';
        $mail->Password = 'Duocai2015';
        $mail->CharSet = 'utf-8';
        $mail->From = 'dev@duocai.cn';
        $mail->FromName = APP_NAME . " - 技术研发中心";
        $mail->setLanguage("zh-cn");


    }
}
