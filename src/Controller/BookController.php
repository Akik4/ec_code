<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BookRead;
use App\Entity\Book;
use App\Form\BookFormType;

class BookController extends AbstractController
{
    #[Route("/request/",  methods: ['POST'])]
    public function list(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()){
            $book = new Book();
            $bookRead = new BookRead();
            
            $form = $this->createForm(BookFormType::class, $bookRead);
            $form->handleRequest($request);
            
            $book = $entityManager->getRepository(Book::class)->findById($request->request->all()['book_form']['_book_id']);
            
            print_r($book->getName());

            if($form->isSubmitted() /* && $form->isValid() */){
                $date = (new \DateTime());
                
                $bookRead->setBook($book); 
                $bookRead->setUserId($this->getUser()->getId());
                $bookRead->setCreatedAt($date);
                $bookRead->setUpdatedAt($date);

                $entityManager->persist($bookRead);
                $entityManager->flush();
            }
    
        }
        $response = new Response();
        return $response->send();
    }
}
