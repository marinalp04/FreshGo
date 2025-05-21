<?php

namespace App\Twig;

use App\Entity\PedidoCliente;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class CartExtension extends AbstractExtension implements GlobalsInterface
{
    private Security $security;
    private EntityManagerInterface $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    public function getGlobals(): array
    {
        $cartCount = 0;

        $usuario = $this->security->getUser();

        if ($usuario) {
            $pedido = $this->em->getRepository(PedidoCliente::class)->findOneBy([
                'usuario' => $usuario,
                'estado' => PedidoCliente::ESTADO_CARRITO,
            ]);

            if ($pedido) {
                $cartCount = 0;
                foreach ($pedido->getDetallePedidoClientes() as $detalle) {
                    $cartCount += $detalle->getCantidad();
                }
            }
        }

        return [
            'cartCount' => $cartCount,
        ];
    }
}
