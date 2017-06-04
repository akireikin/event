<?php

declare(strict_types=1);

namespace Akireikin\EventTest;

use Akireikin\Event\Dispatcher;
use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_add_listener_and_then_dispatch_event(): void
    {
        // arrange
        $dispatcher = new Dispatcher();
        $event = new class() {
            public $wasHandled = false;
        };
        $listener = new class() {
            public function __invoke($event): void
            {
                $event->wasHandled = true;
            }
        };

        // act
        $dispatcher
            ->addListener(get_class($event), get_class($listener))
            ->dispatch($event);

        // assert
        self::assertTrue($event->wasHandled);
    }
}
