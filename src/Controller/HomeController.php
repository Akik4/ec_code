<?php

namespace App\Controller;

use App\Repository\BookReadRepository;
use App\Entity\BookRead;
use App\Form\BookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    private BookReadRepository $readBookRepository;

    // Inject the repository via the constructor
    public function __construct(BookReadRepository $bookReadRepository)
    {
        $this->bookReadRepository = $bookReadRepository;
    }

    #[Route('/', name: 'app.home')]
    public function index(Request $request): Response
    {
        $book = new BookRead();
        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);

        $user = $this->getUser();
        $userId     = 1;
        $booksRead  = $this->bookReadRepository->findByUserId($userId, false);

        // Render the 'hello.html.twig' template
        return $this->render('pages/home.html.twig', [
            'booksRead' => $booksRead,
            'name'      => 'Accueil', // Pass data to the view
            'email' => $user ? $user->getEmail() : "",
            'form' => $form
        ]);
    }
}
