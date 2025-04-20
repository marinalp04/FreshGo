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
        return $this->render('producto/index.html.twig', [
            'producto' => $producto,
        ]);
    }


}
