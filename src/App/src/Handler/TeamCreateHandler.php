<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use \Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

class TeamCreateHandler implements RequestHandlerInterface
{
    
    private $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            $body = $request->getParsedBody();

            if(empty($body["country_id"])) {
                return (new JsonResponse([
                    "success" => false, 
                    "message" => "The field country_id is required"
                ]))->withStatus(400);
            }

            if(empty($body["name"])) {
                return (new JsonResponse([
                    "success" => false, 
                    "message" => "The field name is required"
                ]))->withStatus(400);
            }

            $this->db->insert("teams", $body);

            return new JsonResponse(["success" => true, "message" => "Created successfully"]);

        } catch(ForeignKeyConstraintViolationException $e) {
            return (new JsonResponse(["success" => false, "message" => "Country not found"]))->withStatus(400);
        }
    }
}
