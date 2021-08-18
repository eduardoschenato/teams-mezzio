<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class TeamCreateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TeamCreateHandler
    {
        return new TeamCreateHandler($container->get('db'));
    }
}
