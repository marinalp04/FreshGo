<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
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

    // #[Route('/categoria/{id}', name: 'app_categoria')]
    // public function productosPorCategoria(int $id, CategoriaRepository $categoriaRepo): Response
    // {
    //     $categoria = $categoriaRepo->find($id);

    //     if (!$categoria) {
    //         throw $this->createNotFoundException('Categoría no encontrada');
    //     }

    //     $productos = $categoria->getProductos(); 

    //     return $this->render('categoria/productos.html.twig', [
    //         'categoria' => $categoria,
    //         'productos' => $productos,
    //     ]);
    // }

}
