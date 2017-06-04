<?php

declare(strict_types=1);

/*
 * This file is part of the Event package.
 *
 * (c) Aleksei Akireikin <opexus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Akireikin\EventTest;

use Akireikin\Event\Dispatcher;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

final class DispatcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_add_listener_and_then_dispatch_event(): void
    {
        // arrange
        $event = $this->mockEvent();
        $listener = $this->mockListener();
        $container = $this->mockContainer();
        $container
            ->expects($this->once())
            ->method('get')
            ->with(get_class($listener))
            ->willReturn($listener);
        $dispatcher = new Dispatcher($container);

        // act
        $dispatcher
            ->addListener(get_class($event), get_class($listener))
            ->dispatch($event);

        // assert
        self::assertTrue($event->wasHandled);
    }

    /**
     * @test
     */
    public function it_does_not_throw_exception_when_no_listener_added(): void
    {
        // arrange
        $dispatcher = new Dispatcher($this->mockContainer());

        // act
        $dispatcher->dispatch((object) []);

        // assert - no exception thrown
        $this->addToAssertionCount(1);
    }

    /**
     * Mock event.
     *
     * @return object
     */
    private function mockEvent()
    {
        return new class() {
            public $wasHandled = false;
        };
    }

    /**
     * Mock listener.
     *
     * @return callable
     */
    private function mockListener(): callable
    {
        return new class() {
            public function __invoke($event): void
            {
                $event->wasHandled = true;
            }
        };
    }

    /**
     * Mock container.
     *
     * @return \Psr\Container\ContainerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function mockContainer(): ContainerInterface
    {
        return $this->createMock(ContainerInterface::class);
    }
}
