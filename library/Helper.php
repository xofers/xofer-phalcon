<?php

/**
 * @description :工具类
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016-04-07
 */

namespace Dc\Lib;

use Phalcon\Config;
use Phalcon\Exception;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Config\Adapter\Json;
use Phalcon\Config\Adapter\Php;
use Phalcon\Config\Adapter\Yaml;

class Helper
{
    /**
     * 读取文件配置
     *
     * @param $filePath
     * @return Ini|Json|Php|Yaml
     *
     * @throws Exception
     */
    public static function loadFile($filePath)
    {
        if (!is_file($filePath)) {
            throw new Exception('Config file not found');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        switch ($extension) {
            case 'ini':
                return new Ini($filePath);
            case 'json':
                return new Json($filePath);
            case 'php':
            case 'php5':
            case 'inc':
                return new Php($filePath);
            case 'yml':
            case 'yaml':
                return new Yaml($filePath);
            default:
                throw new Exception('Config adapter for .'  . $extension . ' files is not support');
        }
    }

    /**
     * 读取文件夹下的配置文件并且合并
     *
     * @param string $configsDir
     * @param mixed  $configs
     *
     * @return Config
     */
    public static function loadDir($configsDir = '',$configs = [])
    {
        $config = new Config();
        if($configs instanceof Config){
            $config = $configs;
        }

        if(is_array($configs) && !empty($configs)){
            $config->merge(new Config($configs));
        }

        if (!is_dir($configsDir)) {
            return $config;
        }

        $fileSystem = new \FilesystemIterator($configsDir, \FilesystemIterator::SKIP_DOTS);
        foreach ($fileSystem as $configFile) {
            if ($configFile->isFile()) {
                $cfg = self::loadFile($configFile->getRealPath());
                $config->merge($cfg);
            }
        }

        return $config;
    }
}