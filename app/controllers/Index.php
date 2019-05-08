<?php
/**
 * 默认控制器
 */

use Base\BaseException;
use Dymyw\Yaf\Controller\ApiBaseController;

/**
 * Class IndexController
 */
class IndexController extends ApiBaseController
{
    /**
     * @throws \Dymyw\Yaf\Response\Exception
     */
    public function indexAction()
    {
        throw BaseException::error(BaseException::NORMAL_ERROR);
    }
}
