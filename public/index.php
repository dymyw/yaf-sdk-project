<?php
/**
 * 入口文件
 */

date_default_timezone_set('Asia/Shanghai');
define('APP_PATH', dirname(__DIR__));

$app = new \Yaf\Application(APP_PATH . '/conf/application.ini');

$app->bootstrap()->run();
