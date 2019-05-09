<?php
/**
 * 基础异常处理
 */

namespace Base;

use Dymyw\Yaf\Response\Exception;

/**
 * Class BaseException
 * @package Base
 */
class BaseException extends Exception
{
    const NORMAL_ERROR              = 100001;

    /**
     * 获取错误 Map
     *
     * @return array
     */
    protected static function getCodeMap() : array
    {
        return [
            self::NORMAL_ERROR              => 'success',
        ];
    }
}
