<?php

use Base\BaseAction;
use Dymyw\Yaf\Utils\AsyncMsg\RabbitMqUtil;
use Thumper\Producer;

/**
 * 消息发送
 *
 * Class PushMsgAction
 */
class PushMsgAction extends BaseAction
{
    /**
     * @return mixed|void
     */
    public function _exec()
    {
        // 消息体
        $msg = [
            'name'  => 'dymyw',
            'type'  => 'php',
        ];
        $data = json_encode($msg);

        // Routing key
        $routingKey = 'project.light.msg_transfer';

        // conn
        $conn = RabbitMqUtil::getInstance()->getConnection();

        // producer
        $producer = new Producer($conn);
        $producer->setExchangeOptions([
            'name'  => 'project.light.direct',
            'type'  => 'direct',
        ]);

        /**
         * 设置参数
         *
         * content_type         消息内容的类型
         * content_encoding     消息内容的编码格式
         * priority             消息的优先级
         * correlation_id       关联id
         * reply_to             用于指定回复的队列的名称
         * expiration           消息的失效时间
         * message_id           消息id
         * timestamp            消息的时间戳
         * type                 类型
         * user_id              用户id
         * app_id               应用程序id
         * cluster_id           集群id
         */
        $producer->setParameter('priority', 100);
        $producer->setParameter('message_id', md5(uniqid(mt_rand(), true)));
        $producer->setParameter('timestamp', time());
        $producer->setParameter('expiration', time() + 20);

        // send
        $producer->publish($data, $routingKey);
    }
}
