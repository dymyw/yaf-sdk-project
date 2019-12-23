<?php
/**
 * 获取分类列表
 */

use App\Models\Common\CategoryModel;
use Base\BaseAction;
use Common\ConstMap;

/**
 * Class ListsAction
 */
class ListsAction extends BaseAction
{
    /**
     * @return mixed|void
     */
    public function _exec()
    {
        $id         = $this->getController()->getRequest()->getParam('id');
        $depth      = (int) $this->getController()->getRequest()->getParam('depth', 1);
        $rowStatus  = (int) $this->getController()->getRequest()->getParam('row_status');
        $fieldType  = $this->getController()->getRequest()->getParam('field_type');

        $model = new CategoryModel();

        $where = [
            'ORDER' => [
                'type'      => ConstMap::ORDER_BY_ASC,
                'depth'     => ConstMap::ORDER_BY_ASC,
                'weight'    => ConstMap::ORDER_BY_DESC,
            ],
        ];
        $this->addOrderBy($where);
        $model->whereAppend($where, 'id', $id);
        $model->whereAppend($where, 'depth', $depth);
        $model->whereAppend($where, 'row_status', $rowStatus);

        $fields     = $model->getFieldByType($fieldType);
        $options    = $this->getPaginationParams();
        $lists      = $model->getPaginatedList($fields, $where, null, $options);

        $this->response($lists);
    }
}
