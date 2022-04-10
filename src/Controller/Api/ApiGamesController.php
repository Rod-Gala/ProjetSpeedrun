<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;

class ApiGamesController extends AbstractController
{
    /**
     * Get Parameter from get request parameters and return an array of games
     */
    public function gameSearch(Request $request, GameRepository $games): Response
    {

        // Get vars from the request parameters
        $g_name = $request->query->get("g_name");
        $number = $request->query->get("number");
        $plateform = $request->query->get("plateform");

        if (empty($g_name)) {
            return new Response("Erreur: la variable g_name n'a pas été renseignée", 400);
        }

        $query_result = $games->findNumberByFragName($g_name, $number, $plateform);

        // generate the game url route with the name and add it to the array
        for ($i = 0; $i < count($query_result) ; $i++) {
            $query_result[$i]['url'] = $this->generateUrl('game.show', array( "name" => $query_result[$i]['name']));
        }

        // Json Encode the array and send it as plain text for the client
        $jsonPayload = json_encode($query_result);
        $response = new Response();
        $response->setContent($jsonPayload);
        $response->headers->set('Content-Type', 'text/plain');
        return $response->prepare($request);
    }
}
