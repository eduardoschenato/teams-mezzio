<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class TeamDeleteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TeamDeleteHandler
    {
        return new TeamDeleteHandler($container->get('db'));
    }
}
