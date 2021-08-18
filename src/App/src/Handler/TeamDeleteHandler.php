<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TeamDeleteHandler implements RequestHandlerInterface
{

    private $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $teams = $this->db->createQueryBuilder()
                            ->select('*')
                            ->from('teams')
                            ->where('id = ?')
                            ->setParameter(0, $request->getAttribute('id'))
                            ->execute()
                            ->fetchAll();
        
        if(empty($teams)) {
            return (new JsonResponse([
                "success" => false, 
                "message" => "Team not found"
            ]))->withStatus(404);
        }
        
        $this->db->delete("teams", ["id" => $request->getAttribute('id')]);

        return new JsonResponse(["success" => true, "message" => "Deleted successfully"]);
    }
}
