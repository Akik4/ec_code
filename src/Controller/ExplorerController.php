<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookReadRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ExplorerController extends AbstractController
{
    
    #[Route('/explorer', name: 'app_explorer')]
    public function index(ManagerRegistry $registry, PaginatorInterface $paginator, Request $request): Response
    {
        if($this->getUser()){
            $user = $this->getUser();
        }

        $BookReadRepo = new BookReadRepository($registry);
        
        $books = $BookReadRepo->getBooksRead();



        $pagination = $paginator->paginate(
            $books, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
             6/* limit per page */
        );
    
        // parameters to template
        // return $this->render('article/list.html.twig', ['pagination' => $pagination]);
    
        // print_r($books);

        return $this->render('pages/explorer.html.twig', [
            'email' => $user ? $user->getEmail() : "",
            'books' => $pagination
        ]);
    }
}
