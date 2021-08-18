<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;

class CountryListHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountryListHandler
    {
        return new CountryListHandler($container->get('db'));
    }
}
