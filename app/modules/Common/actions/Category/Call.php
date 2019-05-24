<?php
/**
 * 接口请求
 */

use Base\BaseAction;

/**
 * Class CallAction
 */
class CallAction extends BaseAction
{
    public function _exec()
    {
        /**
         * =============================================================================================================
         * 原始（请求单个）
         * =============================================================================================================
         */
//        $apiConfig = [
//            'host'      => 'beta',
//            'url'       => '/open/article/detail',
//            'method'    => 'get',
//        ];
//        $params = [
//            'id' => 507,
//        ];
//        $default = null;
//        $api = new \Base\BaseApi($apiConfig, $params, $default);
//
//        // 执行
//        \Dymyw\Yaf\Utils\Agent\AgentApi::request($api);
//
//        // 获取结果
//        var_dump($api->getResponse());

        /**
         * =============================================================================================================
         * 原始（请求多个）
         * =============================================================================================================
         */
//        $api = [
//            new \Base\BaseApi([
//                'host'      => 'beta',
//                'url'       => '/open/article/detail',
//                'method'    => 'get',
//            ], [
//                'id' => 507,
//            ], false),
//            new \Base\BaseApi([
//                'host'      => 'beta',
//                'url'       => '/open/article/detail',
//                'method'    => 'get',
//            ], [
//                'id' => 508,
//            ], false),
//        ];
//
//        // 执行
//        \Dymyw\Yaf\Utils\Agent\AgentApi::request(...$api);
//
//        // 获取结果
//        foreach ($api as $item) {
//            /** @var \Base\BaseApi $item */
//            var_dump($item->getResponse());
//        }

        /**
         * =============================================================================================================
         * CallApi（请求单个）
         * =============================================================================================================
         */
//        $apiConfig = [
//            'host'      => 'beta',
//            'url'       => '/open/article/detail',
//            'method'    => 'get',
//        ];
//        $params = [
//            'id' => 507000000,
//        ];
////        $default = null;
//        $default = false;
//
//        // 执行
//        $response = \Common\CallApi::exec($apiConfig, $params, $default);
//
//        // 获取结果
//        var_dump($response);

        /**
         * =============================================================================================================
         * CallApi（请求多个）
         * =============================================================================================================
         */
//        $api = [
//            [
//                [
//                    'host'      => 'beta',
//                    'url'       => '/open/article/detail',
//                    'method'    => 'get',
//                ],
//                [
//                    'id' => 50700000,
//                ],
//                false,
//            ],
//            [
//                [
//                    'host'      => 'beta',
//                    'url'       => '/open/article/detail',
//                    'method'    => 'get',
//                ],
//                [
//                    'id' => 5080000,
//                ],
//            ],
//        ];
//
//        // 执行
//        $response = \Common\CallApi::execMulti(...$api);
//
//        // 获取结果
//        var_dump($response);
    }
}
