<?php
declare(strict_types=1);

namespace tests;

use Exception;
use simplify\amqp\AMQPManager;
use think\amqp\contract\AMQPInterface;
use think\amqp\service\AMQPService;

class AMQPTest extends BaseTest
{
    /**
     * @var AMQPInterface
     */
    private $amqp;

    public function setUp(): void
    {
        parent::setUp();
        $this->app->register(AMQPService::class);
        $this->amqp = $this->app->get(AMQPInterface::class);
    }

    public function testClient()
    {
        try {
            $this->amqp->channel(function (AMQPManager $manager) {
                $manager->queue('test')
                    ->setDeclare([
                        'durable' => true
                    ]);
                sleep(2);
                $manager->queue('test')
                    ->delete();
                $this->assertNull(null);
            });
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

}