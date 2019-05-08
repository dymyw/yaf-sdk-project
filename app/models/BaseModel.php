<?php
/**
 * 基础数据模型
 */

namespace App\Models;

use Dymyw\Yaf\Model\AbstractModel;

/**
 * Class BaseModel
 * @package App\Models
 */
abstract class BaseModel extends AbstractModel
{
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
}
