<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class TeamUpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TeamUpdateHandler
    {
        return new TeamUpdateHandler($container->get('db'));
    }
}
