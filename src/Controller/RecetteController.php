<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  #[Route('/recette' )]
final class RecetteController extends AbstractController
{
    #[Route('', name: 'app_recette')]
    public function index(RecetteRepository $recettes,): Response
    {
        $recettes = $recettes->findAll();

        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes
        ]);
    }

    #[Route('/show/{id}', name: 'app_show_recette')]
    public function show(RecetteRepository $recettes,$id): Response
    {
        $recettes = $recettes->find($id);
        return $this->render('recette/show.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes
        ]);
    }
    
    
    #[Route('/delete/{id}', name: 'app_delete_recette')]
    public function delete(EntityManagerInterface $em,$id,RecetteRepository $recette): Response
    {
        $recette = $recette->find($id);
        if ($recette) {
            $em->remove($recette);
            $em->flush();
        }
        return $this->redirectToRoute('app_recette');
    }


        


    #[Route('/create', name: 'app_create_recette')]
    public function createRecette(EntityManagerInterface $em,Request $request): Response
    {
        $recette = new Recette();    
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recette = $form->getData();
            $recette->setCreatedAt(new \DateTimeImmutable());
            $recette->setUpdatedAt(new \DateTimeImmutable());
            $recette->setUser($this->getUser());
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute('app_recette');
        }

        
        return $this->render('recette/create.html.twig', [
            'controller_name' => 'RecetteController',
            'form' => $form->createView(),
        ]);
    }


    #[Route('/mes-recette', name: 'app_mesRecette')]
    public function mesRecettes(RecetteRepository $recette,): Response
    {
        $user = $this->getUser();
        $recettes = $recette->findBy(['user' => $user]);

        return $this->render('recette/mesRecettes.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes,
            'user'=> $user
        ]);
    }


    

    #[Route('/edit-recette/{id}', name: 'app_edit-recette')]
    public function edit(EntityManagerInterface $em,$id,Request $request,RecetteRepository $recette): Response
    {
           $recette = $recette->find($id);   
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recette = $form->getData();
            $recette->setCreatedAt(new \DateTimeImmutable());
            $recette->setUpdatedAt(new \DateTimeImmutable());
            $recette->setUser($this->getUser());
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute('app_recette');
        }

        return $this->render('recette/edit.html.twig', [
            'controller_name' => 'RecetteController',
            'form' => $form->createView(),
        ]);
    }
}
