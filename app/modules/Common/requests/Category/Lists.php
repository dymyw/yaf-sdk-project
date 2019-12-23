<?php

namespace Common\Request\Category;

use Dymyw\Yaf\Request\AbstractRequest;

/**
 * Class Lists
 * @package Common\Request\Category
 */
class Lists extends AbstractRequest
{
    public function checkParams()
    {
        parent::checkParams();

        $this->intStrToArray(['id']);
    }
}
