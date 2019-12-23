<?php
/**
 * 基础控制器方法
 */

namespace Base;

use Common\ConstMap;
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

    /**
     * 添加排序条件
     *
     * @param $where
     * @param string $prefix
     */
    public function addOrderBy(&$where, $prefix = '')
    {
        $orderField = $this->getController()->getRequest()->getParam('order_field');
        $orderType  = strtoupper($this->getController()->getRequest()->getParam('order_type'));

        if ($orderField && in_array($orderType, [ConstMap::ORDER_BY_ASC, ConstMap::ORDER_BY_DESC])) {
            if ($prefix) {
                $orderField = "{$prefix}.{$orderField}";
            }

            $where['ORDER'] = [
                "{$orderField}" => $orderType,
            ];
        }
    }
}
