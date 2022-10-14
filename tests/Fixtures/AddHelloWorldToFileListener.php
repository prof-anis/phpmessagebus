<?php

namespace Test\Fixtures;

use Tobexkee\Phpmessagebus\EventBus\Interfaces\EventHandlerInterface;
use Tobexkee\Phpmessagebus\EventBus\Interfaces\EventInterface;

class AddHelloWorldToFileListener implements EventHandlerInterface
{

    public function handle(EventInterface $event): void
    {

    }
}
