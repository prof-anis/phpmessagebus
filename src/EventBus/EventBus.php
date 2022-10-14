<?php

namespace Tobexkee\Phpmessagebus\EventBus;

use Tobexkee\Phpmessagebus\EventBus\Interfaces\EventInterface;
use Tobexkee\Phpmessagebus\EventBus\Middlewares\TriggerEventObserversMiddleware;
use Tobexkee\Phpmessagebus\MessageBus;

class EventBus extends MessageBus
{
    protected const DEFAULT_MIDDLEWARES = [
        TriggerEventObserversMiddleware::class,
    ];

    public function dispatch(EventInterface|string $event)
    {
        foreach (self::DEFAULT_MIDDLEWARES as $middleware) {
            $this->addMiddleware(new $middleware);
        }

        $this->handle(
            $this->prepareEventForDispatch($event)
        );
    }

    public function prepareEventForDispatch(EventInterface|string $event): EventInterface
    {
        return is_string($event) ? new StringEvent($event) : $event;
    }
}
