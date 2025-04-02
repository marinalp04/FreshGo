<?php

namespace App\Entity;

use App\Repository\DetallePedidoProveedorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetallePedidoProveedorRepository::class)]
class DetallePedidoProveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallePedidoProveedors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PedidoProveedor $pedido_proveedor = null;

    #[ORM\ManyToOne(inversedBy: 'detallePedidoProveedors')]
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

    public function getPedidoProveedor(): ?PedidoProveedor
    {
        return $this->pedido_proveedor;
    }

    public function setPedidoProveedor(?PedidoProveedor $pedido_proveedor): static
    {
        $this->pedido_proveedor = $pedido_proveedor;

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
