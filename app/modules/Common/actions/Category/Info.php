<?php
/**
 * 获取分类信息
 */

use App\Models\Common\CategoryModel;
use Base\BaseAction;
use Common\Exception\CategoryException;

/**
 * Class InfoAction
 */
class InfoAction extends BaseAction
{
    /**
     * @return mixed|void
     * @throws \Dymyw\Yaf\Response\Exception
     */
    public function _exec()
    {
        $id         = (int) $this->getController()->getRequest()->getParam('id');
        $fieldType  = $this->getController()->getRequest()->getParam('field_type');

        $model = new CategoryModel();

        $where = [];
        $model->whereAppend($where, 'id', $id);

        $fields = $model->getFieldByType($fieldType);
        $info   = $model->get($fields, $where);
        $model->checkEmpty(
            $info,
            CategoryException::getErrMsg(CategoryException::CATEGORY_NOT_EXISTS_ERROR),
            CategoryException::CATEGORY_NOT_EXISTS_ERROR,
            [
                'where' => $where,
                'file'  => __FILE__,
                'line'  => __LINE__,
            ]
        );

        $this->response($info);
    }
}
