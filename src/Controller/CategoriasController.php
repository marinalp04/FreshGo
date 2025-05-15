<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
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
       $categorias = $entityManager->getRepository(Categoria::class)->findBy(['activo' => true]);

        return $this->render('categorias/index.html.twig', [
            'categorias' => $categorias,
        ]);
    }

    #[Route('/categoria/{id}', name: 'categoria_productos')]
    public function productosPorCategoria(int $id, CategoriaRepository $categoriaRepo): Response
    {
        $categoria = $categoriaRepo->find($id);

       if (!$categoria || !$categoria->isActivo()) {
            throw $this->createNotFoundException('Categoría no encontrada o inactiva');
        }
        
        $productos = $categoria->getProductos();
        $fotosPorProducto = [];

        foreach ($productos as $producto) {
            $foto = $producto->getFotoProductos()->first();
            $fotosPorProducto[$producto->getId()] = $foto;
        }

        return $this->render('categorias/productos.html.twig', [
            'categoria' => $categoria,
            'productos' => $productos,
            'fotosPorProducto' => $fotosPorProducto
        ]);
    }

}
