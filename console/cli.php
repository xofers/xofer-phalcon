<?php
/**
 *
 * @description :PhpStorm
 * @author      :游川江<youcj@duocai.cn>
 * @copyright   :Copyright © 2016-2017 多彩饰家 www.duocai.cn
 * @datetime    :2016/4/9 0009 17:34
 *
 */

use Phalcon\Di\FactoryDefault\Cli as CliDi;
use Phalcon\Cli\Environment\Environment;
use Dc\Module\Console;

define('APP_DEBUG', true);
define('APP_NAME', '多彩换新');
define('APP_PATH', realpath('..'));
define('ROOT_PATH', __DIR__.DIRECTORY_SEPARATOR);
define("IS_DEV",isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local']) ? $_SERVER['DC_ENV'] : false);

//引入包资源
require_once '../vendor/autoload.php';

//注册类加载
require_once '../console/module/loader.php';

$di         =   new CliDi();

require_once '../console/module/services.php';

$console    =   new Console();
$console->setDI($di);
$console->setEnvironment(new Environment);
//echo $console->getEnvironment()-

