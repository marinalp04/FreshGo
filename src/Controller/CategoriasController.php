<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriasController extends AbstractController
{
    #[Route('/categorias', name: 'app_categorias')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categorias = $entityManager->getRepository(Categoria::class)->findAll();

        return $this->render('categorias/index.html.twig', [
            'categorias' => $categorias,
        ]);
    }
}
