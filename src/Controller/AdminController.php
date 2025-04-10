<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
 #[Route('/admin')]
final class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function index(RecetteRepository $recettes): Response

    {
        $recettes= $recettes->findall();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'recettes' => $recettes,
        ]);
    }
}
