<?php

namespace App\Controller;

use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(CategoriaRepository $categoriaRepo): Response
    { 
        $categoriasDestacadas = $categoriaRepo->findBy(['destacada' => true], null);
        return $this->render('index.html.twig', [
            'categoriasDestacadas' => $categoriasDestacadas
        ]);
    }
}
