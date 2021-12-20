<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * Function used to shown all users to the admin
     */
    public function showAll (UserRepository $repository)
    {
        $users = $repository->getAllUsername();

        return $this->render('admin/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Function used to update the role of an user 
     */
    public function showOneUser($slug, UserRepository $repository, EntityManagerInterface $manager, Request $request)
    {
        //Get the user's id from his username
        $idUser = $repository->getIdFromUsername($slug);

        //Get the user from his id
        $user = $repository->find($idUser[0]);

        //Get the current role of a user from his username
        $role = $repository->getRoleFromUsername($slug);

        //Convert the current role to string 
        $role = $this->roleToString($role);

        //Creation of a form from UserType
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        //If the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()){

            //Get the data from the form
            $data = $form->getData();

            //Get the new role for display purpose 
            $new_role = $repository->getRoleFromUsername($slug);

            //Send the updated objet/entity to the database
            $manager->persist($data);
            $manager->flush();

            return $this->render('admin/confirmUpdateRole.html.twig', [
                'username' => $slug,
                'role' => $new_role
            ]); 
        }

        return $this->render('admin/updateRole.html.twig', [
            'username' => $slug,
            'role' => $role,
            'form' => $form->createView()
        ]);
    }

    /**
     * Function used to convert an array of role in a string
     */
    public function roleToString($role){

        switch ($role[0]["roles"][0]) {
            case 'ROLE_ADMIN':
                return 'Admin';
                break;

            case 'ROLE_USER':
                return 'User';
                break;

            default:
                return "User";
                break;
        }
        
    }


}
