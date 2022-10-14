<?php

namespace Tobexkee\Phpmessagebus\CommandBus\Interfaces;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $event): void;
}
