<?php

namespace Common;

use Base\BaseApi;
use Base\BaseException;
use Dymyw\Yaf\Response\Exception;
use Dymyw\Yaf\Utils\Agent\AgentApi;
use Dymyw\Yaf\Utils\Logger;
use Dymyw\Yaf\Utils\ResultUtil;

/**
 * Class CallApi
 * @package Common
 */
class CallApi
{
    /**
     * 执行多个接口请求并返回结果
     *
     * @param mixed ...$arguments
     * @return array
     * @throws Exception
     */
    public static function execMulti(...$arguments)
    {
        $apiInstance = [];
        foreach ($arguments as $argument) {
            $apiInstance[] = new BaseApi($argument[0], $argument[1], $argument[2] ?? null);
        }

        // 接口请求
        try {
            AgentApi::request(...$apiInstance);
        } catch (\Exception $e) {
            Logger::getInstance()->error(BaseException::getErrMsg(BaseException::CALL_API_ERROR), BaseException::CALL_API_ERROR, [
                'arguments' => $arguments,
                'response'  => 'error',
                'file'      => __FILE__,
                'line'      => __LINE__,
                'errMsg'    => $e->getMessage(),
                'errCode'   => $e->getCode(),
                'type'      => 'request error',
            ]);
        }

        // 获取接口返回的结果集
        $allResponse = [];
        foreach ($apiInstance as $item) {
            /** @var BaseApi $item */
            $default = $item->getDefault();

            try {
                $response = $item->getResponse();
            } catch (Exception $e) {
                // 接口返回没有正常数据
                Logger::getInstance()->error(BaseException::getErrMsg(BaseException::CALL_API_ERROR), BaseException::CALL_API_ERROR, [
                    'request'   => $item->getRequest(),
                    'response'  => 'no result',
                    'file'      => __FILE__,
                    'line'      => __LINE__,
                    'errMsg'    => $e->getMessage(),
                    'errCode'   => $e->getCode(),
                ]);

                // 没有设置接口请求默认值，直接抛出异常
                if (is_null($default)) {
                    throw BaseException::error(BaseException::CALL_API_ERROR);
                } else {
                    $allResponse[] = $default;
                }
            }

            $apiResponseConfig = BaseApi::getApiResponseConfig($item->getRequest()['host']);
            // 接口调用结果不是正确状态
            if ($response[$apiResponseConfig['err_no_field']] != $apiResponseConfig['success_no']) {
                Logger::getInstance()->error(BaseException::getErrMsg(BaseException::CALL_API_ERROR), BaseException::CALL_API_ERROR, [
                    'request'   => $item->getRequest(),
                    'response'  => $response,
                    'file'      => __FILE__,
                    'line'      => __LINE__,
                    'errMsg'    => $response[$apiResponseConfig['err_msg_field']],
                    'errCode'   => $response[$apiResponseConfig['err_no_field']],
                ]);

                // 没有设置接口请求默认值，直接抛出异常
                if (is_null($default)) {
                    throw new Exception($response[$apiResponseConfig['err_msg_field']], $response[$apiResponseConfig['err_no_field']]);
                } else {
                    $allResponse[] = $default;
                }
            }
            // 接口调用成功
            else {
                $allResponse[] = $response[ResultUtil::DATA];
            }
        }

        return $allResponse;
    }

    /**
     * 执行单个接口请求
     *
     * @param $apiConfig
     * @param $data
     * @param null $default
     * @return mixed
     * @throws Exception
     */
    public static function exec($apiConfig, $data, $default = null)
    {
        return self::execMulti([$apiConfig, $data, $default])[0];
    }
}
