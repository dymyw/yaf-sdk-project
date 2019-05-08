<?php
/**
 * 分类异常处理
 */

namespace Common\Exception;

use Base\BaseException;

/**
 * Class CategoryException
 * @package Common\Exception
 */
class CategoryException extends BaseException
{
    const CATEGORY_EXISTS_ERROR     = 110001;
    const CREATE_CATEGORY_ERROR     = 110002;
    const UPDATE_CATEGORY_ERROR     = 110003;
    const CATEGORY_NOT_EXISTS_ERROR = 110004;

    /**
     * 获取错误 Map
     *
     * @return array
     */
    protected static function getCodeMap() : array
    {
        return [
            self::CATEGORY_EXISTS_ERROR     => '分类已存在',
            self::CREATE_CATEGORY_ERROR     => '创建分类失败',
            self::UPDATE_CATEGORY_ERROR     => '更新分类失败',
            self::CATEGORY_NOT_EXISTS_ERROR => '分类不存在',
        ];
    }
}
