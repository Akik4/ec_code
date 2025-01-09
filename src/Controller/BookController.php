<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BookRead;
use App\Form\BookFormType;

class BookController extends AbstractController
{
    #[Route("/request/",  methods: ['POST'])]
    public function list(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()){
            $book = new BookRead();
            $form = $this->createForm(BookFormType::class, $book);
            $form->handleRequest($request);
            
            
            if($form->isSubmitted() && $form->isValid()){
                $date = (new \DateTime());

                $book->setUserId($this->getUser()->getId());
                $book->setCreatedAt($date);
                $book->setUpdatedAt($date);

                $entityManager->persist($book);
                $entityManager->flush();
            }
    
        }
        $response = new Response();
        return $response->send();
    }
}
