<?php

namespace Tobexkee\Phpmessagebus;

class MessageBus
{
    private array $middlewares = [];

    public function __construct(array $middlewares = [])
    {
        foreach ($middlewares as $middleware) {
            $this->addMiddleware($middleware);
        }
    }

    public function addMiddleware(object $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function handle(object $message): void
    {
        call_user_func($this->prepareNextMiddleware(0), $message);
    }

    private function prepareNextMiddleware(int $position): callable
    {
        if (! isset($this->middlewares[$position])) {
            return function () {
            };
        }

        $middleware = $this->middlewares[$position];

        return function ($message) use ($middleware, $position) {
            $middleware->handle($message, $this->prepareNextMiddleware($position + 1));
        };
    }

}
