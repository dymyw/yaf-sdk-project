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
    const REQUEST_METHOD_ERROR      = 100002;

    /**
     * 获取错误 Map
     *
     * @return array
     */
    protected static function getCodeMap() : array
    {
        return [
            self::NORMAL_ERROR              => 'success',
            self::REQUEST_METHOD_ERROR      => '请求方式错误',
        ];
    }
}
