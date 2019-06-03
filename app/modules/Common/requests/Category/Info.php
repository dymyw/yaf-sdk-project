<?php

namespace Common\Request\Category;

use Dymyw\Yaf\Request\AbstractRequest;
use Dymyw\Yaf\Response\Exception;
use Dymyw\Yaf\Utils\Validator\Validator;

/**
 * Class Info
 * @package Common\Request\Category
 */
class Info extends AbstractRequest
{
    /**
     * @throws Exception
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
