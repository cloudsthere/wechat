<?php

namespace EasyWeChat\App;

use EasyWeChat\Core\AbstractAPI;

/**
 * Class App.
 */
class App extends AbstractAPI
{
    const API_AUTHORIZATION = 'https://api.weixin.qq.com/sns/jscode2session';
    const API_QRCODE = 'https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode';
    private $appId;
    private $secret;
    private $payment = [];


    public function __construct($appId, $secret, $payment = [])    
    {
        $this->appId = $appId;
        $this->secret = $secret;
        $this->payment = $payment;
    }

    public function auth($code)
    {
        $params = [
            'appid' => $this->appId,
            'secret' => $this->secret,
            'grant_type' => 'authorization_code',
            'js_code' => $code,
        ];

        return $this->parseJson('get', [self::API_AUTHORIZATION, $params]);
    }

    public function qrcode($path, $width = 430)
    {
        return $this->parseJSON('json', [self::API_QRCODE, compact('path', 'width')]);
    }
    
}