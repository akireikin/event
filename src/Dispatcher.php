<?php

declare(strict_types=1);

namespace Akireikin\Event;

class Dispatcher
{
    private $listeners = [];

    /**
     * Add Listener to event.
     *
     * @param string $eventClass
     * @param string $listenerClass
     *
     * @return \Akireikin\Event\Dispatcher
     */
    public function addListener(string $eventClass, string $listenerClass): self
    {
        $this->listeners[$eventClass][] = $listenerClass;

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
        foreach ($this->listeners[get_class($event)] as $listener) {
            (new $listener())($event);
        }

        return $this;
    }
}
