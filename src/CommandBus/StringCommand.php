<?php

namespace Tobexkee\Phpmessagebus\CommandBus;

use App\Services\MessageBus\CommandBus\Interfaces\CommandInterface;

class StringCommand implements CommandInterface
{
    public function __construct(protected string $command)
    {
    }

    public function command(): string
    {
        return $this->command;
    }
}
