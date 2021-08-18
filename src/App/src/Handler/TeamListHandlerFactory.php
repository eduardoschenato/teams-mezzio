<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class TeamListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TeamListHandler
    {
        return new TeamListHandler($container->get('db'));
    }
}
