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
    const NORMAL_ERROR                  = 100001;
    const CALL_API_ERROR                = 100002;

    // MySQL
    const MYSQL_FETCH_INFO_EMPTY_ERROR  = 100010;

    /**
     * 获取错误 Map
     *
     * @return array
     */
    protected static function getCodeMap() : array
    {
        return [
            self::NORMAL_ERROR                  => 'success',
            self::CALL_API_ERROR                => '接口调用错误',

            // MySQL
            self::MYSQL_FETCH_INFO_EMPTY_ERROR  => '数据库获取数据为空',
        ];
    }
}
