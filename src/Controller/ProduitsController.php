<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Products;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/catalogue', name: 'produits')]
    public function index(Request $request): Response
    {
        $produits = $this ->entityManager->getRepository(Products::class)->findBy(array(),array('createAt' => 'DESC'));

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            $produits = $this->entityManager->getRepository(Products::class)->findWithSearch($search);
        }
        
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }

    #[Route('/produit/{slug}', name: 'produit')]
    public function show($slug): Response
    {
        $produit = $this->entityManager->getRepository(Products::class)->findOneBySlug($slug);

        if (!$produit) {
            return $this->redirectToRoute('produits');
        }
        return $this->render('produits/produit.html.twig', [
            'produit' => $produit
        ]);
    }
}