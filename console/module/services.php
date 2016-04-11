<?php
/**
 * Services are globally registered in this file
 */
use Phalcon\Config\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\DI\FactoryDefault\c,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * Registering a config
 */
$di->setShared('config',function(){

    $configDir = APP_PATH.'/config/';
    $configDir .= !IS_DEV ?: 'dev/';
    $config = Loader::loadDir($configDir);

    IS_DEV && IS_DEV == 'dev' ?: $config->merge(Loader::loadDir(APP_PATH.'/config/'.IS_DEV.'/'));
    return $config;
});

/**
 * get all config
 */
$config = $di->getShared('config');

/**
 * Registering a logger
 */
$di->set('logger',function () use($config) {

    $logger = new Monolog\Logger(MODULE_NAME);
    $config->log->file = str_replace('MODULE_NAME',MODULE_NAME,$config->log->file);
    $logger->pushHandler(new Monolog\Handler\StreamHandler($config->log->file,$config->log->level));

    return $logger;
});

/**
 * Registering a mysql write connnect
 */
$di->setShared('dbWrite', function() use ($config) {
    return new DbAdapter($config->db_w->toArray());
});

/**
 * Registering a mysql read connnect
 */
$di->setShared('dbRead', function() use ($config) {
    return new DbAdapter($config->db_r->toArray());
});