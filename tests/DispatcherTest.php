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
