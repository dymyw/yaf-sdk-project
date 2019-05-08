<?php

use Dymyw\Yaf\Controller\ApiBaseController;

class CategoryController extends ApiBaseController
{
    /**
     * @var array
     */
    public $actions = [
        'info'      => 'modules/Common/actions/Category/Info.php',
    ];
}
