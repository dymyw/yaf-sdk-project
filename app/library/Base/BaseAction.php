<?php
/**
 * 基础控制器方法
 */

namespace Base;

use Dymyw\Yaf\Controller\AbstractAction;
use Dymyw\Yaf\Response\Exception;
use Dymyw\Yaf\Utils\Logger;

/**
 * Class BaseAction
 * @package Base
 */
abstract class BaseAction extends AbstractAction
{
    /**
     * @return mixed
     */
    abstract function _exec();

    /**
     * @return mixed|void
     * @throws Exception
     */
    final public function execute()
    {
        try {
            $this->_exec();
        } catch (Exception $e) {
            Logger::getInstance()->error($e->getMessage(), $e->getCode(), [
                'efile'     => $e->getFile(),
                'eline'     => $e->getLine(),
                'etrace'    => $e->getTraceAsString(),
                'file'      => __FILE__,
                'line'      => __LINE__,
            ]);

            throw $e;
        }
    }
}
