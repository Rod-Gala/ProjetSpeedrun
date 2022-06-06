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
        // Get var g_name and number from the request parameters
        $g_name = $request->query->get("g_name");
        //Number of games that we want
        $number = $request->query->get("number");

        // If number is defined
        if ($number) {
            // Query the database with the defined number
            $query_result = $games->findNumberByFragName($g_name, $number);
        } else {
            // Query the database
            $query_result = $games->findNumberByFragName($g_name);
        }

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
