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

namespace Akireikin\Event;

use Psr\Container\ContainerInterface;

class Dispatcher
{
    /**
     * @var array
     */
    private $listenerClasses = [];

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * Constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Add listener to event.
     *
     * @param string $eventClass
     * @param string $listenerClass
     *
     * @return \Akireikin\Event\Dispatcher
     */
    public function addListener(string $eventClass, string $listenerClass): self
    {
        $this->listenerClasses[$eventClass][] = $listenerClass;

        return $this;
    }

    /**
     * Dispatch an event.
     *
     * @param object $event
     *
     * @return \Akireikin\Event\Dispatcher
     */
    public function dispatch($event): self
    {
        $eventClass = get_class($event);
        foreach ($this->listenerClasses[$eventClass] ?? [] as $listenerClass) {
            $listener = $this->container->get($listenerClass);
            $listener($event);
        }

        return $this;
    }
}
