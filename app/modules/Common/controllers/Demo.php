<?php

use Dymyw\Yaf\Controller\ApiBaseController;

/**
 * 相关演示
 *
 * Class DemoController
 */
class DemoController extends ApiBaseController
{
    /**
     * @var array
     */
    public $actions = [
        'call'          => 'modules/Common/actions/Demo/Call.php',
        'pushmsg'       => 'modules/Common/actions/Demo/PushMsg.php',
        'consumemsg'    => 'modules/Common/actions/Demo/ConsumeMsg.php',
    ];
}
