<?php
/**
 * 异常和错误处理
 */

use Dymyw\Yaf\Utils\ResultUtil;

/**
 * Class ErrorController
 */
class ErrorController extends \Yaf\Controller_Abstract
{
    /**
     * @param $exception
     */
    public function errorAction($exception)
    {
        $this->getResponse()->setHeader("Content-Type", "application/json");
        $this->getResponse()->setBody(ResultUtil::exception($exception));
    }
}
