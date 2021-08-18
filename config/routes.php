<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/confederations', App\Handler\ConfederationListHandler::class, 'confederations.list');
    $app->get('/countries', App\Handler\CountryListHandler::class, 'coutries.list');
    $app->get('/teams', App\Handler\TeamListHandler::class, 'teams.list');
    $app->get('/confederations/{confederation_id}/countries', App\Handler\ConfederationCountryListHandler::class, 'confederations.countries');
    $app->get('/confederations/{confederation_id}/countries/{country_id}/teams', App\Handler\CountryTeamListHandler::class, 'countries.teams');
    $app->get('/teams/{id}', App\Handler\TeamGetHandler::class, 'teams.get');
    $app->post('/teams', [BodyParamsMiddleware::class, App\Handler\TeamCreateHandler::class], 'teams.create');
    $app->put('/teams/{id}', App\Handler\TeamUpdateHandler::class, 'teams.update');
    $app->delete('/teams/{id}', App\Handler\TeamDeleteHandler::class, 'teams.delete');
};
