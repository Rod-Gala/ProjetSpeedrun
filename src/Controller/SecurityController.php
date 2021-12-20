<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * Function used to register a new user
     * 
     * @Route ("/registration", name="app_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher)
    {

        //Creation of a new User
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        //If the form is submitted and all fields are valid
        if ($form->isSubmitted() && $form->isValid()) {

            /* To hash the plain password 
            Use hashPassword()
            Get the password from the user */
            $hashedPassword = $hasher->hashPassword(
                $user,
                $user->getPassword()
            );

            //Set the new hashed Password to the User
            $user->setPassword($hashedPassword);

            //Get and set the role by default
            $role = $user->getRoles();
            $user->setRoles($role);

            //Send to the database
            $manager->persist($user);
            $manager->flush();
            return $this->redirect($this->generateUrl('app_login'));
        }
        return $this->render('security\registration.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * Function used to login an user 
     */
    public function login (AuthenticationUtils $authenticationUtils): Response{
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
