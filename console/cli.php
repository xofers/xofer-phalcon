#!/usr/local/duocai/php/bin/php -q
<?php
/**
 *
 * @description :Cli应用入口
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/9 0009 17:34
 *
 */

use Phalcon\Di\FactoryDefault\Cli as CliDI;

//引入包资源
require_once '../vendor/autoload.php';

//设置变量
$_SERVER = array_merge($_SERVER,\Phalcon\Config\Loader::load('config/cli.ini')['env']->toArray());

//定义常量
define('APP_DEBUG', true);
define('APP_NAME', '多彩换新');
define('APP_PATH', realpath('..'));
define('ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR);

//注册tasks目录下的所有类
(new \Phalcon\Loader())->registerDirs([
    'tasks'
],true)->register();

//创建一个DI
$di = new CliDI();

//创建一个cli应用
$app = new Danzabar\CLI\Application($di);

//加载task
$tasks  = [];
if(isset($argv[1])){
    if($argv[1] == 'help'){
        if(isset($argv[2])){
            $tasks[] = explode(":",$argv[2])[0].'Task';
        }else{
            $fileSystem = new \FilesystemIterator('tasks', \FilesystemIterator::SKIP_DOTS);
            foreach ($fileSystem as $configFile) {
                $tasks[] = $configFile->getBaseName('.php');
            }
        }
    }else{
        $tasks[] = explode(":",$argv[1])[0].'Task';
    }
}
array_walk($tasks,function($v,$k,$app){
    if(class_exists($v = ucfirst($v))){
        $app->add(new $v());
    }
},$app);

//开始执行
$app->start($argv);
