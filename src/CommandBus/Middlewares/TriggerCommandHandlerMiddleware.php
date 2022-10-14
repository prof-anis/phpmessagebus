<?php

namespace Tobexkee\Phpmessagebus\CommandBus\Middlewares;

use Exception;
use Tobexkee\Phpmessagebus\CommandBus\Interfaces\CommandInterface;
use Tobexkee\Phpmessagebus\CommandBus\StringCommand;

class TriggerCommandHandlerMiddleware
{
    public function handle(CommandInterface $command, callable $next)
    {
        $handler = $this->fetchCommandHandler($command);

        call_user_func([new $handler, 'handle'], $command);
    }

    private function fetchCommandHandler(CommandInterface $command)
    {
        $register = require __DIR__.'/../../register.php';

        $command = $this->resolveCommandIdentifier($command);

        if (array_key_exists($command, $register['commands'])) {
            return $register['commands'][$command];
        }

        throw new Exception(sprintf('%s is not registered in the command bus.', $command));
    }

    private function resolveCommandIdentifier(CommandInterface $command): string
    {
        return $command instanceof StringCommand ? $command->command() : get_class($command);
    }
}
