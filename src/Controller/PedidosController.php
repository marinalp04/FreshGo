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
    #[Route('/carrito/anadir/{id}', name: 'anadir_al_carrito', methods: ['POST'])]
    public function anadirAlCarrito(
        Producto $producto,
        EntityManagerInterface $em,
        Security $security,
        SessionInterface $session,
        Request $request,
    ): Response {
        $usuario = $security->getUser();

        if (!$usuario) {
            $session = $this->requestStack->getSession();
            $session->set('_target_path', $request->getUri());
            return $this->redirectToRoute('app_login');
        }

        $cantidad = max((int) $request->request->get('cantidad', 1), 1);

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

        // Comprobar si ya existe el producto en el carrito antes de añadirlo
        $detalleExistente = $em->getRepository(DetallePedidoCliente::class)->findOneBy([
            'pedido_cliente' => $pedido,
            'producto' => $producto
        ]);

        if ($detalleExistente) {
            $detalleExistente->setCantidad($detalleExistente->getCantidad() + $cantidad);
        } else {
            $detalleExistente = new DetallePedidoCliente();
            $detalleExistente->setPedidoCliente($pedido);
            $detalleExistente->setProducto($producto);
            $detalleExistente->setCantidad($cantidad);
            $detalleExistente->setPrecioUnitario($producto->getPrecio());
            $em->persist($detalleExistente);
        }

        // Actualizar el total
        $pedido->setTotal($pedido->getTotal() + ($producto->getPrecio() * $cantidad));
       
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

    //Funcion para modificar la cantidad de un producto en el carrito
    #[Route('/carrito/modificar/{id}', name: 'modificar_cantidad_carrito', methods: ['POST'])]
    public function modificarCantidad(
        DetallePedidoCliente $detalle,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $cantidad = max((int) $request->request->get('cantidad'), 1);
        $diferencia = $cantidad - $detalle->getCantidad();
        $detalle->setCantidad($cantidad);

        // Actualiza el total del pedido
        $pedido = $detalle->getPedidoCliente();
        $pedido->setTotal($pedido->getTotal() + ($diferencia * $detalle->getPrecioUnitario()));

        $em->flush();

        return $this->redirectToRoute('mostrar_carrito');
    }

    //Funcion para eliminar un producto del carrito
    #[Route('/carrito/eliminar/{id}', name: 'eliminar_del_carrito', methods: ['POST'])]
    public function eliminarDelCarrito(
        DetallePedidoCliente $detalle,
        EntityManagerInterface $em
    ): Response {
        $pedido = $detalle->getPedidoCliente();
        $pedido->setTotal($pedido->getTotal() - ($detalle->getCantidad() * $detalle->getPrecioUnitario()));

        $em->remove($detalle);
        $em->flush();

        return $this->redirectToRoute('mostrar_carrito');
    }

    //Funcion para vaciar el carrito
    #[Route('/carrito/vaciar', name: 'vaciar_carrito', methods: ['POST'])]
    public function vaciarCarrito(
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

        if ($pedido) {
            foreach ($pedido->getDetallePedidoClientes() as $detalle) {
                $em->remove($detalle);
            }

            $pedido->setTotal(0);
            $em->flush();
        }

        return $this->redirectToRoute('mostrar_carrito');
    }

    //Funcion para mostrar el resumen del pedido
    #[Route('/pedido/resumen', name: 'pedido_resumen')]
    public function resumen(
        EntityManagerInterface $em,
        Security $security
    ): Response {
        $usuario = $security->getUser();

        $pedido = $em->getRepository(PedidoCliente::class)->findOneBy([
            'usuario' => $usuario,
            'estado' => 'carrito',
        ]);

        if (!$pedido || $pedido->getDetallePedidoClientes()->isEmpty()) {
            return $this->redirectToRoute('mostrar_carrito');
        }

        $subtotal = 0;
        foreach ($pedido->getDetallePedidoClientes() as $detalle) {
            $subtotal += $detalle->getPrecioUnitario() * $detalle->getCantidad();
        }

        $envioGratisMinimo = 30;
        $costeEnvio = 0;
        $faltan = 0;

        if ($subtotal < $envioGratisMinimo) {
            $costeEnvio = 3.99;
            $faltan = $envioGratisMinimo - $subtotal;
        }

        $total = $subtotal + $costeEnvio;

        $fechaEntrega = (new \DateTime())->modify('+2 days');

        return $this->render('pedidos/resumen.html.twig', [
            'pedido' => $pedido,
            'subtotal' => $subtotal,
            'costeEnvio' => $costeEnvio,
            'total' => $total,
            'faltanParaEnvioGratis' => $faltan,
            'fechaEntrega' => $fechaEntrega,
        ]);
    }


}
