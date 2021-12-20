<?php

namespace App\Controller;

use App\Repository\RunRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function index(RunRepository $repository): Response
    {
        /* $recentRuns = 
        [
            [
                'game_img' => 'https://media.senscritique.com/media/000020110678/source_big/Metroid_Dread.png',
                'game_name' => 'Metroid Dread',
                'category_name' => 'Any%, No Major Glitches',
                'username' => 'Gala',
                'time_run' => '1h 25m 18s',
                'date_run' => '2 weeks ago'
            ],
            [
                'game_img' => 'https://media.senscritique.com/media/000020110678/source_big/Metroid_Dread.png',
                'game_name' => 'Metroid Dread',
                'category_name' => 'Any%, No Major Glitches',
                'username' => 'Gala',
                'time_run' => '1h 25m 18s',
                'date_run' => '2 weeks ago'
            ],
            [
                'game_img' => 'https://media.senscritique.com/media/000020110678/source_big/Metroid_Dread.png',
                'game_name' => 'Metroid Dread',
                'category_name' => 'Any%, No Major Glitches',
                'username' => 'Gala',
                'time_run' => '1h 25m 18s',
                'date_run' => '2 weeks ago'
            ],
            [
                'game_img' => 'https://media.senscritique.com/media/000020110678/source_big/Metroid_Dread.png',
                'game_name' => 'Metroid Dread',
                'category_name' => 'Any%, No Major Glitches',
                'username' => 'Gala',
                'time_run' => '1h 25m 18s',
                'date_run' => '2 weeks ago'
            ],
            [
                'game_img' => 'https://media.senscritique.com/media/000020110678/source_big/Metroid_Dread.png',
                'game_name' => 'Metroid Dread',
                'category_name' => 'Any%, No Major Glitches',
                'username' => 'Gala',
                'time_run' => '1h 25m 18s',
                'date_run' => '2 weeks ago'
            ]
        ]; */

        
        // public function index(Request $request, GameRepository $repository): Response
        // {
            // $keyword = $request->get('g_name');
            // if ($keyword != null){
            //     $query_result = $repository->findNumberByFragName(10, $keyword);
            //     return $this->render('game/search.html.twig', ["results" => $query_result, "input_value" => $keyword]);
            // } else {
            //     $query_result = $repository->findNumberOrderASC(10);
            //     return $this->render('game/search.html.twig', ["results" => $query_result]);
            //}
                    
        //}
        // Quesque tu veux faire? détaille les étapes dans un commentaire block Y
        /*
         * 1- récupérer les données des runs
         *      1-1 OK 😀
         *      1-2 Je l'ai importé, mtn je veux pouvoir l'utiliser dans ma fonction, 
         *          donc pour que ce soit bien propre je vais lui donner un alias OUI 😀
         *      1-3 Quesque tu as fais dans le repo? Donc cette fonction renvoie quoi? Y
         * 2- les afficher
         */
        $recentRuns = $repository->findFiveOrderBydateRunDESC(); // Get five latest runs 😃
        // Alors tu as récupérer des données, mais est ce que tu as besoin de toute les champs de ces données ?
        // En regardant dans le template, tu peux définir ce dont tu as besoin,
        // Le dossier entity te permet de visualiser ta table sous forme de classe , 
        // Donc tu peux modifier ta fonction dans le repo
        return $this->render('home/index.html.twig', ['recentRuns' => $recentRuns,]);
    }
}
