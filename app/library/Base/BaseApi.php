<?php
/**
 * 基础 Api
 */

namespace Base;

use Dymyw\Yaf\Utils\Agent\AbstractApi;
use Dymyw\Yaf\Utils\EnvInfo;
use Yaf\Registry;

/**
 * Class BaseApi
 * @package Base
 */
class BaseApi extends AbstractApi
{
    const ERROR_NO      = 'errno';
    const ERROR_MSG     = 'errmsg';
    const SUCCESS_NO    = '0';
    const SUCCESS_MSG   = 'success';

    /**
     * 接口配置
     *
     * @var array
     */
    private $apiConfig = [];

    /**
     * BaseApi constructor.
     *
     * @param array $apiConfig
     * @param array $params
     * @param mixed|null $default
     */
    public function __construct(array $apiConfig, array $params, $default = null)
    {
        $this->apiConfig    = $apiConfig;
        $this->params       = $params;
        $this->default      = $default;
    }

    /**
     * 获取请求
     *
     * @return array
     */
    public function getRequest()
    {
        $this->setParams('request_id', EnvInfo::getRequestId());

        /**
         * 获取配置中的值
         *
         * @param $key
         * @param null $default
         * @return null
         */
        $getApiVal = function ($key, $default = null) {
            return $this->apiConfig[$key] ?? $default;
        };

        $host   = $getApiVal('host', 'default');
        $url    = Registry::get('config')->host->internal->$host . $getApiVal('url', '/');

        return [
            'url'   => $url,
            'data'  => array_merge($getApiVal('params', []), $this->params),
            'type'  => strtoupper($getApiVal('method', 'get')),
        ];
    }
}
