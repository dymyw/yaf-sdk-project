<?php
/**
 * 获取分类信息
 */

use App\Models\Common\CategoryModel;
use Base\BaseAction;
use Common\Exception\CategoryException;
use Dymyw\Yaf\Response\Exception;

/**
 * Class InfoAction
 */
class InfoAction extends BaseAction
{
    /**
     * @return mixed|void
     * @throws Exception
     */
    public function _exec()
    {
        $id = (int) $this->getController()->getRequest()->getParam('id');

        $where = [
            'id' => $id,
        ];

        $model  = new CategoryModel();
        $info   = $model->get(CategoryModel::$tableFields, $where);
        if (empty($info)) {
            throw CategoryException::error(CategoryException::CATEGORY_NOT_EXISTS_ERROR);
        }

        $this->response([
            'info' => $info,
        ]);
    }
}
