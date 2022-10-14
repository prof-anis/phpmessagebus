<?php

namespace Tobexkee\Phpmessagebus\CommandBus;

use Tobexkee\Phpmessagebus\CommandBus\Interfaces\CommandInterface;
use Tobexkee\Phpmessagebus\CommandBus\Middlewares\TriggerCommandHandlerMiddleware;
use Tobexkee\Phpmessagebus\MessageBus;

class CommandBus extends MessageBus
{
    protected const MIDDLEWARES = [
        TriggerCommandHandlerMiddleware::class,
    ];

    public function run(CommandInterface|string $command)
    {
        foreach (self::MIDDLEWARES as $middleware) {
            $this->addMiddleware(new $middleware);
        }

        $this->handle($this->prepareCommandForDispatch($command));
    }

    public function prepareCommandForDispatch(CommandInterface|string $command): StringCommand
    {
        return is_string($command) ? new StringCommand($command) : $command;
    }
}
