<?php

namespace App\Entity;

use App\Repository\DetallePedidoClienteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetallePedidoClienteRepository::class)]
class DetallePedidoCliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallePedidoClientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PedidoCliente $pedido_cliente = null;

    #[ORM\ManyToOne(inversedBy: 'detallePedidoClientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $producto = null;

    #[ORM\Column]
    private ?float $cantidad = null;

    #[ORM\Column]
    private ?float $precio_unitario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPedidoCliente(): ?PedidoCliente
    {
        return $this->pedido_cliente;
    }

    public function setPedidoCliente(?PedidoCliente $pedido_cliente): static
    {
        $this->pedido_cliente = $pedido_cliente;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): static
    {
        $this->producto = $producto;

        return $this;
    }

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecioUnitario(): ?float
    {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario(float $precio_unitario): static
    {
        $this->precio_unitario = $precio_unitario;

        return $this;
    }
}
