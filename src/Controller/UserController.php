<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PlateformType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function show (User $user): Response
    {
        return $this->render('user/show.html.twig',
        [
            'user' => $user,
        ]);
    }

}
