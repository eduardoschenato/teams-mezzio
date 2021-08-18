<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CountryListHandler implements RequestHandlerInterface
{
    
    private $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $countries = $this->db->createQueryBuilder()
                                ->select('c.*, conf.name as confederation')
                                ->from('countries', 'c')
                                ->innerJoin('c', 'confederations', 'conf', 'conf.id = c.confederation_id')
                                ->execute()
                                ->fetchAll();
        
        return new JsonResponse($countries);
    }
}
