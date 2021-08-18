<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TeamListHandler implements RequestHandlerInterface
{
    
    private $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $teams = $this->db->createQueryBuilder()
                            ->select('t.*, c.name as country')
                            ->from('teams', 't')
                            ->innerJoin('t', 'countries', 'c', 'c.id = t.country_id')
                            ->execute()
                            ->fetchAll();
        
        return new JsonResponse($teams);
    }
}
