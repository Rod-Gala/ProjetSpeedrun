<?php 

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Bonsoir ceci est un commentaire
class ApiUserController extends AbstractController{
    
    public function userSearch(Request $request, UserRepository $userRepo): Response
    {
        //Récupération du username de puis la request
        $name = $request->query->get("username");

        //Récupération des resultats de la query
        $queryResults = $userRepo->getUsernameFromFragUsername($name);

        for($i = 0; $i < count($queryResults) ; $i++){
            $queryResults[$i]['url'] = $this->generateUrl('user.show', ['username' => $queryResults[$i]['username']]);
        }

        //Encodage et return de la reponse
        $jsonResults = json_encode($queryResults);
        $response = new Response();
        $response->setContent($jsonResults);
        $response->headers->set('Content-Type', 'text/plain');
        return $response->prepare($request);
    }
}
