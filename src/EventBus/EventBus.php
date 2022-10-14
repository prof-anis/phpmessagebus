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

    public static function dispatch(EventInterface|string $event, array $middlewares = []): void
    {
        $bus = new self($middlewares);

        foreach (self::DEFAULT_MIDDLEWARES as $middleware) {
            $bus->addMiddleware(new $middleware);
        }

        $bus->handle(
            $bus->prepareEventForDispatch($event)
        );
    }

    public function prepareEventForDispatch(EventInterface|string $event): EventInterface
    {
        return is_string($event) ? new StringEvent($event) : $event;
    }
}
