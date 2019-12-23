<?php

use Dymyw\Yaf\Controller\ApiBaseController;

/**
 * 公共分类相关操作
 *
 * Class CategoryController
 */
class CategoryController extends ApiBaseController
{
    /**
     * @var array
     */
    public $actions = [
        'info'          => 'modules/Common/actions/Category/Info.php',
        'lists'         => 'modules/Common/actions/Category/Lists.php',
    ];
}
