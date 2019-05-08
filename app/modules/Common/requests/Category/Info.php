<?php

namespace Common\Request\Category;

use Dymyw\Yaf\Request\AbstractRequest;
use Dymyw\Yaf\Utils\Validator\Validator;

/**
 * Class Info
 * @package Common\Request\Category
 */
class Info extends AbstractRequest
{
    /**
     * @throws \Dymyw\Yaf\Response\Exception
     */
    public function checkParams()
    {
        parent::checkParams();

        $rules = [
            'id'  => 'required|integer|min_numeric,1',
        ];
        Validator::validate($this->getParams(), $rules);
    }
}
