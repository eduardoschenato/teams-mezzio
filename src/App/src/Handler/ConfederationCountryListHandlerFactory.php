<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class ConfederationCountryListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ConfederationCountryListHandler
    {
        return new ConfederationCountryListHandler($container->get('db'));
    }
}
