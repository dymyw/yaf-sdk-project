<?php

use Dymyw\Yaf\Plugin\FormRequest;

/**
 * Class Bootstrap
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract
{
    /**
     * 存储配置
     */
    public function _initConfig()
    {
        $config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set('config', $config);
    }

    /**
     * 倒入自动加载器
     */
    public function _initLoader()
    {
        \Yaf\Loader::import(APP_PATH . '/vendor/autoload.php');
    }

    /**
     * 注册插件
     *
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        // 参数验证插件
        $formRequest = new FormRequest();
        $dispatcher->registerPlugin($formRequest);
    }
}
