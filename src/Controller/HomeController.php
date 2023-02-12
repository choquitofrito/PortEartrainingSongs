<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {

        if ($this->isGranted('ROLE_USER')){
            return ($this->redirectToRoute ('library_show_all'));
        }

        return $this->redirectToRoute("app_login");
    }

}
