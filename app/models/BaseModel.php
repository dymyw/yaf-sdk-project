<?php
/**
 * 基础数据模型
 */

namespace App\Models;

use Base\BaseException;
use Dymyw\Yaf\Model\AbstractModel;
use Dymyw\Yaf\Response\Exception;
use Dymyw\Yaf\Utils\Logger;

/**
 * Class BaseModel
 * @package App\Models
 */
abstract class BaseModel extends AbstractModel
{
    /**
     * 字段类型
     */
    const FIELD_TYPE_DEFAULT    = 0;    // 默认类型，全部字段
    const FIELD_TYPE_MAIN       = 1;    // 主要字段，通用字段

    /**
     * @var array 表所有字段
     */
    public static $tableFields  = [];

    /**
     * @var array 所有类型对应的字段列表
     */
    public static $fieldList    = [];

    /**
     * 插入数据
     *
     * @param $data
     * @return bool|\PDOStatement
     */
    public function insert($data)
    {
        $datetime = date("Y-m-d H:i:s");

        if (key_exists(0, $data)) {
            foreach ($data as &$item) {
                if (empty($item['created_at'])) {
                    $item['created_at'] = $datetime;
                }
                $item['updated_at'] = $datetime;
            }
        } else {
            if (empty($data['created_at'])) {
                $data['created_at'] = $datetime;
            }
            $data['updated_at'] = $datetime;
        }

        return parent::insert($data);
    }

    /**
     * 更新数据
     *
     * @param $data
     * @param null $where
     * @return bool|\PDOStatement
     */
    public function update($data, $where = null)
    {
        $datetime = date("Y-m-d H:i:s");

        if (empty($data['updated_at'])) {
            $data['updated_at'] = $datetime;
        }

        return parent::update($data, $where);
    }

    /**
     * 给 where 追加条件
     *
     * @param $where
     * @param $field
     * @param $value
     * @param string $op
     * @return bool
     */
    public function whereAppend(&$where, $field, $value, $op = '=')
    {
        if (empty($value)) {
            return false;
        }

        switch ($op) {
            case '=':
                $where[$field] = $value;
                break;
            default:
                $whereField = $field . '[' . $op . ']';
                $where[$whereField] = $value;
        }

        return true;
    }

    /**
     * 给 updateData 追加数据
     *
     * @param $data
     * @param $field
     * @param $value
     * @param string $filter
     * @return bool
     */
    public function updateDataAppend(&$data, $field, $value, $filter = 'empty') {
        switch ($filter) {
            case 'empty':
                if (empty($value)) {
                    return false;
                }
                break;
            case 'null':
                if (is_null($value)) {
                    return false;
                }
                break;
            default:
                return false;
        }

        $data[$field] = $value;

        return true;
    }

    /**
     * 根据字段类型获取对应字段列表
     *
     * @param int $fieldType
     * @return mixed
     */
    public function getFieldByType($fieldType = self::FIELD_TYPE_MAIN)
    {
        return self::getFieldsByType($fieldType);
    }

    /**
     * 根据字段类型获取对应字段列表
     *
     * @param int $fieldType
     * @return array|mixed
     */
    public static function getFieldsByType($fieldType = self::FIELD_TYPE_MAIN)
    {
        if (!is_numeric($fieldType)) {
            $fieldType = static::FIELD_TYPE_MAIN;
        }

        // 存在指定类型对应的字段列表
        if (array_key_exists($fieldType, static::$fieldList)) {
            // 直接使用
            $fields = static::$fieldList[$fieldType];

            // 在 $fieldList 中，FIELD_TYPE_DEFAULT 对应的字段列表为空
            if (empty($fields) && $fieldType == static::FIELD_TYPE_DEFAULT) {
                $fields = static::$tableFields;
            }
        }

        // 没找到指定类型对应的字段列表，但存在主要字段列表则使用主要字段列表
        elseif ($fieldType != static::FIELD_TYPE_MAIN && array_key_exists(static::FIELD_TYPE_MAIN, static::$fieldList)) {
            $fields = static::$fieldList[static::FIELD_TYPE_MAIN];
        }

        // 没找到指定类型对应的字段列表，使用默认的表字段列表
        else {
            $fields = static::$tableFields;
        }

        return $fields;
    }

    /**
     * 检测数据是否为空（主要在 info 接口使用）
     *
     * @param $data
     * @param $errorMsg
     * @param $errorNo
     * @param array $logData
     * @return bool
     * @throws Exception
     */
    public function checkEmpty($data, $errorMsg = '数据库获取数据为空', $errorNo = BaseException::MYSQL_FETCH_INFO_EMPTY_ERROR, $logData = [])
    {
        if (empty($data) || !is_array($data)) {
            $sqlArr = $this->getSqlLog();
            if ($sqlArr) {
                $execSql                = array_pop($sqlArr);
                $logData['executeSql']  = $execSql;
            }

            Logger::getInstance()->error($errorMsg, $errorNo, $logData);
            throw new Exception($errorMsg, $errorNo);
        }

        return true;
    }
}
