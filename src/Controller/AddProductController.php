<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AddProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/ajout/produit', name: 'add_product')]
    public function index(Request $request): Response
    {
        $product = new Products;
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest(($request));
       

        if($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $product ->setCreateAt(new \dateTime());
            $product ->setUser($this->getUser()->getId());
            $product ->setSlug();

            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }

        return $this->render('account/addProduct.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
