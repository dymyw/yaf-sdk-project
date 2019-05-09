<?php
/**
 * 异常和错误处理
 */

use Dymyw\Yaf\Controller\ApiBaseController;
use Dymyw\Yaf\Response\Exception;
use Dymyw\Yaf\Utils\ResultUtil;
use Dymyw\Yaf\Utils\Logger;
use Yaf\Exception\LoadFailed;

/**
 * Class ErrorController
 */
class ErrorController extends ApiBaseController
{
    /**
     * @param $exception
     */
    public function errorAction($exception)
    {
        if ($exception instanceof LoadFailed) {
            $exception = Exception::error(Exception::ERR_URL);
        }

        $this->getResponse()->setHeader("Content-Type", "application/json");
        $this->getResponse()->setBody(ResultUtil::exception($exception));

        Logger::getInstance()->error($exception->getMessage(), $exception->getCode(), [
            'file'  => __FILE__,
            'line'  => __LINE__,
        ]);
    }
}
