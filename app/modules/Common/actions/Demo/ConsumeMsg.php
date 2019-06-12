<?php

use Base\BaseAction;
use Dymyw\Yaf\Utils\AsyncMsg\RabbitMqUtil;
use PhpAmqpLib\Message\AMQPMessage;
use Thumper\Consumer;

/**
 * 消费消息
 *
 * Class ConsumeMsgAction
 */
class ConsumeMsgAction extends BaseAction
{
    /**
     * @return mixed|void
     * @throws Exception
     */
    public function _exec()
    {
        // conn
        $conn = RabbitMqUtil::getInstance()->getConnection();

        // consume
        $consumer = new Consumer($conn);
        $consumer->setQueueOptions([
            'name'  => 'project.light.queue.msg_transfer',
        ]);
        $consumer->setCallback([$this, 'callback']);

        /**
         * 服务质量保证
         *
         * prefetchCount
         *      告诉 RabbitMQ 不要同时给一个消费者推送多于 N 个消息
         *      即一旦有 N 个消息还没有 ack，则该 consumer 将 block 掉，直到有消息 ack
         *      避免大量消息而导致消费端奔溃不可用
         */
        $consumer->setQos([
            'prefetch_count' => 3,
        ]);

        $consumer->consume(2);
    }

    /**
     * @param AMQPMessage $msg
     */
    public function callback($msg)
    {
        $msg = json_decode($msg, true);
        var_dump($msg);
    }
}
