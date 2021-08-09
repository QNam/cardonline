<?php
namespace App\Helpers;

class AppHelper
{
    public function getLogo()
    {
        $serverName = $_SERVER['SERVER_NAME'];
        $config = \Config::get('sites.SITES_LOGO');

        return isset($config[$serverName]) ? $config[$serverName] : asset('static/imgs/logo.png');
    }

    public static function instance()
    {
        return new AppHelper();
    }
}