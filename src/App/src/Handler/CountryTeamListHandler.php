<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CountryTeamListHandler implements RequestHandlerInterface
{
    
    private $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $confederations = $this->db->createQueryBuilder()
                                    ->select('*')
                                    ->from('confederations')
                                    ->where('id = ?')
                                    ->setParameter(0, $request->getAttribute('confederation_id'))
                                    ->execute()
                                    ->fetchAll();
        
        if(empty($confederations)) {
            return (new JsonResponse(["message" => "Confederation not found"]))->withStatus(404);
        }

        $countries = $this->db->createQueryBuilder()
                                ->select('*')
                                ->from('countries')
                                ->where('id = ?')
                                ->setParameter(0, $request->getAttribute('country_id'))
                                ->execute()
                                ->fetchAll();
        
        if(empty($countries)) {
            return (new JsonResponse(["message" => "Country not found"]))->withStatus(404);
        }

        $teams = $this->db->createQueryBuilder()
                            ->select('*')
                            ->from('teams')
                            ->where('country_id = ?')
                            ->setParameter(0, $request->getAttribute('country_id'))
                            ->execute()
                            ->fetchAll();
        
        return new JsonResponse($teams);
    }
}
