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
            'host'  => $host,
            'url'   => $url,
            'data'  => array_merge($getApiVal('params', []), $this->params),
            'type'  => strtoupper($getApiVal('method', 'get')),
        ];
    }

    /**
     * 获取接口返回信息说明
     *
     * @param string $host
     * @return array
     */
    public static function getApiResponseConfig($host = 'default') : array
    {
        $config = [
            'default' => [
                'err_no_field'  => 'err_no',    // 接口错误代码字段名称
                'err_msg_field' => 'err_msg',   // 接口错误信息字段名称
                'success_no'    => 0,           // 接口请求成功的错位代码
                'success_msg'   => 'success',   // 接口请求成功的错误信息
            ],
        ];

        return $config[$host] ?? $config['default'];
    }
}
