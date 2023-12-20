<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first/{firstname<^[a-zA-ZÀ-ÖØ-öø-ÿ-]+$>}
    ', name: 'app_first')]
    public function index(string $firstname): Response
    {   
        return $this->render('first/index.html.twig', [
            'controller_name' => $firstname,
        ]);
    }
}
