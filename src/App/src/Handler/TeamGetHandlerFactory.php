<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class TeamGetHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TeamGetHandler
    {
        return new TeamGetHandler($container->get('db'));
    }
}
