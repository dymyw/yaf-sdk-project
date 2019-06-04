<?php
/**
 * 默认控制器
 */

use Base\BaseException;
use Dymyw\Yaf\Controller\ApiBaseController;
use Dymyw\Yaf\Response\Exception;

/**
 * Class IndexController
 */
class IndexController extends ApiBaseController
{
    /**
     * @throws Exception
     */
    public function indexAction()
    {
        throw BaseException::error(BaseException::NORMAL_ERROR);
    }
}
