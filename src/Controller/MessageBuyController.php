<?php

namespace App\Controller;

use App\Entity\MessageBuy;
use App\Entity\Products;
use App\Entity\Users;
use App\Form\MessageType;
use App\Notification\MessageNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class MessageBuyController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/message/{id}', name: 'message_buy')]
    public function index( Request $request, MailerInterface $mailer): Response
    {

        $message = new MessageBuy();
        $form = $this->createForm(MessageType::class, $message);
        
        $form->handleRequest($request);
        
        $id = $request->attributes->get('id');       
        $product = $this->entityManager->getRepository(Products::class)->find($id);
        $userId = $product->getUser();
        $users = $this->entityManager->getRepository(Users::class)->find($userId);
        if ($form->isSubmitted() && $form->isValid()) {
            $message->setIdPoduct($id);
            
            $email = (new TemplatedEmail())
            ->from('sandrinekencker@hotmail.com')
            ->to($users->getEmail())
            ->subject($product)
            ->htmlTemplate('email/email.html.twig')
            ->context ([
                'message' => $message->getMessage(),
                'mailBuy' => $message->getEmail(),
                'firstnameBuy' => $message->getFirstname(),
                'lastnameBuy' => $message->getLastname(),
                ])
                ;
                
                $mailer->send($email);
                $this->addFlash('success', 'Votre message a bien été envoyé.');
                return $this->redirectToRoute('home');
        }

        return $this->render('message_buy/index.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }


}
