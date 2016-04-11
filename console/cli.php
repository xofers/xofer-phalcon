<?php
/**
 *
 * @description :Cli应用入口
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/9 0009 17:34
 *
 */

use Phalcon\Di\FactoryDefault\Cli as CliDi;
use Phalcon\Cli\Environment\Environment;
use Dc\Module\Console;

//引入包资源
require_once '../vendor/autoload.php';

//设置变量
$_SERVER = array_merge($_SERVER,\Phalcon\Config\Loader::load('config/cli.ini')['env']->toArray());

//定义常量
define('APP_DEBUG', true);
define('APP_NAME', '多彩换新');
define('APP_PATH', realpath('..'));
define('ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR);
define("IS_DEV",isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local']) ? $_SERVER['DC_ENV'] : false);

//注册类加载
require_once '../console/module/loader.php';

$di         =   new CliDi();

//require_once '../console/module/services.php';

$console    =   new Console();
$config =  new \Phalcon\Config([
    'appName' => 'My Console App',
    'version' => '1.0',

    /**
     * tasksDir is the absolute path to your tasks directory
     * For instance, 'tasksDir' => realpath(dirname(dirname(__FILE__))).'/tasks',
     */
    'tasksDir' => APP_PATH.'/console/tasks',

    /**
     * annotationsAdapter is the choosen adapter to read annotations.
     * Adapter by default: memory
     */
    'annotationsAdapter' => 'memory',

    'printNewLine' => true
]);

$di->set('config', function () use ($config) {
    return $config;
});


$console->setDI($di);

$console->setEnvironment(new Environment);


/**
 * Process the console arguments
 */
$arguments = [];
$params = [];

foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {
    $console->handle($arguments);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(255);
}