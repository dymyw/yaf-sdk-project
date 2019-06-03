<?php
/**
 * 公共分类数据模型
 */

namespace App\Models\Common;

use App\Models\BaseModel;

/**
 * Class CategoryModel
 * @package App\Models\Common
 */
class CategoryModel extends BaseModel
{
    /**
     * 数据表名
     */
    const TABLE_NAME            = 't_category';

    /**
     * 类型
     */
    const TYPE_ADDRESS          = 1;

    /**
     * 状态
     */
    const ROW_STATUS_NORMAL     = 1;
    const ROW_STATUS_HIDDEN     = 2;

    /**
     * @var array
     */
    public static $tableFields  = [
        'id',
        'name',
        'pid',
        'weight',
        'depth',
        'type',
        'row_status',
    ];
}
