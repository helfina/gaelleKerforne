<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResgiterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(ResgiterType::class, $user);
        
        return $this->render('register/index.html.twig');
    }
}
