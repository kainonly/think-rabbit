<?php
declare(strict_types=1);

namespace tests;

use Exception;
use think\App;
use PHPUnit\Framework\TestCase;
use simplify\amqp\AMQPManager;
use think\amqp\common\AMQPFactory;
use think\amqp\contract\AMQPInterface;
use think\amqp\service\AMQPService;

class AMQPTest extends TestCase
{
    /**
     * @return App
     */
    public function testNewApp()
    {
        $app = new App();
        $app->initialize();
        $this->assertInstanceOf(
            App::class,
            $app,
            '应用容器创建失败'
        );
        return $app;
    }

    /**
     * @param App $app
     * @return object
     * @depends testNewApp
     */
    public function testRegisterService(App $app)
    {
        $app->register(AMQPService::class);
        $amqp = $app->get(AMQPInterface::class);
        $this->assertInstanceOf(
            AMQPFactory::class,
            $amqp,
            '服务注册失败'
        );
        return $amqp;
    }

    /**
     * @param AMQPInterface $amqp
     * @depends testRegisterService
     */
    public function testClient(AMQPInterface $amqp)
    {
        try {
            $amqp->channel(function (AMQPManager $manager) {
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