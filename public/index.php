<?php
define('APP_NAME', '多彩换新');
define('APP_PATH', realpath('..'));
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define("IS_DEV", isset($_SERVER['DC_ENV']) && in_array($_SERVER['DC_ENV'], ['dev', 'local']) ? $_SERVER['DC_ENV'] : false);

//引入包资源
require_once '../vendor/autoload.php';

try {

    $application = new Phalcon\Mvc\Application();

    $application->setDI(new Phalcon\Di\FactoryDefault());

    $application->useImplicitView(false);

    $modulesManager = new Dc\Modules\Manager($application);

    $modulesManager->handle();

    echo $application->handle()->getContent();

} catch (\Exception $e) {

    echo $e->getMessage(), PHP_EOL;
    echo $e->getTraceAsString();
}