<?php

use Base\BaseAction;
use Dymyw\Yaf\Utils\AsyncMsg\RabbitMqUtil;
use PhpAmqpLib\Wire\AMQPTable;
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

        $this->pushLight($data);
    }

    /**
     * 推送一般消息
     *
     *      exchange
     *          type: direct
     *          name: project.light.direct
     *
     *      Routing key
     *          project.light.msg_transfer
     *
     *      建立 project.light.queue.msg_transfer 绑定
     *          project.light.direct
     *          project.light.msg_transfer
     *
     * @param $msg
     */
    public function pushLight($msg)
    {
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
         * expiration           消息的失效时间，单位：微妙（在这个时间之后会从队列中消失）
         * message_id           消息id
         * timestamp            消息的时间戳
         * type                 类型
         * user_id              用户id
         * app_id               应用程序id
         * cluster_id           集群id
         *
         * application_headers  头部
         */
        $producer->setParameter('expiration', 10000);
        $producer->setParameter('message_id', md5(uniqid(mt_rand(), true)));
        $producer->setParameter('timestamp', time());

        // send
        $producer->publish($msg, $routingKey);
    }

    /**
     * 发送延迟消息
     *
     *      exchange
     *          name: project.delay.direct
     *          type: x-delayed-message
     *          Arguments:
     *              x-delayed-type:	direct
     *
     *      Routing key
     *          project.delay.msg_transfer
     *
     *      建立 project.delay.queue.msg_transfer 绑定
     *          project.delay.direct
     *          project.delay.msg_transfer
     *
     *      message
     *          headers:
     *              x-delay: 延迟时间，单位：微妙（在这个时间之后才会出现在队列中）
     *
     * @param $msg
     */
    public function pushDelay($msg)
    {
        // Routing key
        $routingKey = 'project.delay.msg_transfer';

        // conn
        $conn = RabbitMqUtil::getInstance()->getConnection();

        // producer
        $producer = new Producer($conn);
        $producer->setExchangeOptions([
            'name'      => 'project.delay.direct',
            'type'      => 'x-delayed-message',
        ]);

        /**
         * 设置参数，同 pushLight
         */
        $producer->setParameter('application_headers', new AMQPTable([
            'x-delay' => 30000,
        ]));

        // send
        $producer->publish($msg, $routingKey);
    }
}
