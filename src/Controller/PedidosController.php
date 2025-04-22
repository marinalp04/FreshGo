<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Producto;
use App\Entity\PedidoCliente;
use App\Entity\DetallePedidoCliente;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\SecurityBundle\Security;


final class PedidosController extends AbstractController
{
    public function __construct(private RequestStack $requestStack) {}


    //Funcion paara añadir un producto al carrito
    #[Route('/carrito/anadir/{id}', name: 'anadir_al_carrito')]
    public function anadirAlCarrito(
        Producto $producto,
        EntityManagerInterface $em,
        SecurityBundleSecurity $security,
        SessionInterface $session,
        Request $request,
    ): Response {
        $usuario = $security->getUser();

        if (!$usuario) {
            $session = $this->requestStack->getSession();
            $session->set('_target_path', $request->getUri());
            return $this->redirectToRoute('app_login');
        }

        // Buscar si ya tiene un carrito iniciado
        $pedido = $em->getRepository(PedidoCliente::class)->findOneBy([
            'usuario' => $usuario,
            'estado' => PedidoCliente::ESTADO_CARRITO
        ]);

        if (!$pedido) {
            $pedido = new PedidoCliente();
            $pedido->setUsuario($usuario);
            $pedido->setFechaCreacion(new \DateTime());
            $pedido->setEstado(PedidoCliente::ESTADO_CARRITO);
            $pedido->setTotal(0);
            $em->persist($pedido);
        }

        // Añadir producto a DetallePedidoCliente
        $detalle = new DetallePedidoCliente();
        $detalle->setPedidoCliente($pedido);
        $detalle->setProducto($producto);
        $detalle->setCantidad(1); // Luego lo cambio a cantidad elegida por el usuario
        $detalle->setPrecioUnitario($producto->getPrecio());
        $pedido->setTotal($pedido->getTotal() + $producto->getPrecio());

        $em->persist($detalle);
        $em->flush();

        return $this->redirectToRoute('mostrar_carrito');
    }

    //Funcion para mostrar el carrito
    #[Route('/carrito', name: 'mostrar_carrito')]
    public function mostrarCarrito(
        EntityManagerInterface $em,
        Security $security
    ): Response {
        $usuario = $security->getUser();

        if (!$usuario) {
            return $this->redirectToRoute('app_login');
        }

        $pedido = $em->getRepository(PedidoCliente::class)->findOneBy([
            'usuario' => $usuario,
            'estado' => PedidoCliente::ESTADO_CARRITO,
        ]);

        $detalles = $pedido ? $pedido->getDetallePedidoClientes() : [];

        return $this->render('carrito/mostrar.html.twig', [
            'pedido' => $pedido,
            'detalles' => $detalles,
        ]);
    }

}
