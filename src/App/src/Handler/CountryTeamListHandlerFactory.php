<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class CountryTeamListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountryTeamListHandler
    {
        return new CountryTeamListHandler($container->get('db'));
    }
}
