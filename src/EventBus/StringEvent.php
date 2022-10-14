<?php

namespace Tobexkee\Phpmessagebus\EventBus;

use Tobexkee\Phpmessagebus\EventBus\Interfaces\EventInterface;

class StringEvent implements EventInterface
{
    public function __construct(protected string $event)
    {
    }

    public function event(): string
    {
        return $this->event;
    }
}
