<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;

class AccountController extends AbstractController
{

    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte', name: 'account')]
    
    public function index(): Response
    {
        $idUser = $this->getUser()->getId();
        // rechercher les articles avec la propriété user = 1
        $produitUser = $this->entityManager->getRepository(Products::class)->findUser($idUser);
        // dd($produitUser);
        return $this->render('account/index.html.twig', [
            'produitUser' => $produitUser

        ]);
    }

    // #[Route('/produit', name: 'produit')]
    // public function show(): Response
    // {
    //     $produitUser = $this->entityManager->getRepository(Products::class)->findOneByUser(1);

       
    //     return $this->render('/.html.twig', [
    //         'produitUser' => $produitUser
    //     ]);
    // }
}
