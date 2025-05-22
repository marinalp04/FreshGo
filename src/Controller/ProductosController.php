<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class ProductosController extends AbstractController{
    #[Route('/producto/{id}', name: 'producto_detalle')]
    public function detalle(Producto $producto): Response
    {
        if (!$producto->isActivo() || !$producto->getCategoria()->isActivo()) {
            throw $this->createNotFoundException('Producto no disponible o inactivo');
        }

        $cantidadMaxima = $producto->getCantidadMaximaDisponible();

        return $this->render('producto/index.html.twig', [
            'producto' => $producto,
            'fotos' => $producto->getFotoProductos(),
            'cantidadMaxima' => $cantidadMaxima,
        ]);
    }


}
