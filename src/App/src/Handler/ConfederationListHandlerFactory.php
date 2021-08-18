<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class ConfederationListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ConfederationListHandler
    {
        return new ConfederationListHandler($container->get('db'));
    }
}
