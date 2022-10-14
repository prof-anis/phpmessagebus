<?php

namespace Tobexkee\Phpmessagebus\EventBus\Interfaces;

interface EventHandlerInterface
{
    public function handle(EventInterface $event): void;
}
