<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ConfederationListHandler implements RequestHandlerInterface
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
                                    ->execute()
                                    ->fetchAll();
        
        return new JsonResponse($confederations);
    }
}
