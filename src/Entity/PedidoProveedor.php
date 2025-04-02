<?php

namespace App\Entity;

use App\Repository\PedidoProveedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoProveedorRepository::class)]
class PedidoProveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pedidoProveedors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proveedor $proveedor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column]
    private ?float $total = null;

    /**
     * @var Collection<int, DetallePedidoProveedor>
     */
    #[ORM\OneToMany(targetEntity: DetallePedidoProveedor::class, mappedBy: 'pedido_proveedor')]
    private Collection $detallePedidoProveedors;

    public function __construct()
    {
        $this->detallePedidoProveedors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): static
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, DetallePedidoProveedor>
     */
    public function getDetallePedidoProveedors(): Collection
    {
        return $this->detallePedidoProveedors;
    }

    public function addDetallePedidoProveedor(DetallePedidoProveedor $detallePedidoProveedor): static
    {
        if (!$this->detallePedidoProveedors->contains($detallePedidoProveedor)) {
            $this->detallePedidoProveedors->add($detallePedidoProveedor);
            $detallePedidoProveedor->setPedidoProveedor($this);
        }

        return $this;
    }

    public function removeDetallePedidoProveedor(DetallePedidoProveedor $detallePedidoProveedor): static
    {
        if ($this->detallePedidoProveedors->removeElement($detallePedidoProveedor)) {
            // set the owning side to null (unless already changed)
            if ($detallePedidoProveedor->getPedidoProveedor() === $this) {
                $detallePedidoProveedor->setPedidoProveedor(null);
            }
        }

        return $this;
    }
}
