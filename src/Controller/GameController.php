<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\PlateformRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    public function show(Game $game): Response
    {
        /* L'exemple ci dessous montre qu'il n'est pas necessaire
        * de requeter toutes les relations, elles sont directement
        * query par doctrine lorsque les données sont utilisées
        */
        /* $plateformes = $game->getPlateforms();
        $categories = $game->getCategories();
        $runs = $game->getRuns();
        $users = $game->getUsers(); */

        return $this->render('game/show.html.twig',
            [
                "game" => $game,
                /* "categories" => $categories,
                "plateformes" => $plateformes,
                "runs" => $runs,
                "users" => $users */
            ]);
        //return $response->prepare($request);
    }

    /**
     * Recupere le corps du post (si il existe) et genere un template
     * @param request La requete faite a cette route
     * @param repository Le repository de l'entite Game
     */
    public function index(Request $request, GameRepository $repository): Response
    {

        $keyword = $request->get('g_name');

        if ($keyword != null){
            $query_result = $repository->findNumberByFragName($keyword, 10);
            return $this->render('game/search.html.twig', ["results" => $query_result, "input_value" => $keyword]);

        } else {
            $query_result = $repository->findNumberOrderASC(10);
            return $this->render('game/search.html.twig', ["results" => $query_result]);
        }
        
    }

    public function edit(Game $game): Response
    {
        return $this->render("game/edit.html.twig", ["game" => $game]);
    }
}
