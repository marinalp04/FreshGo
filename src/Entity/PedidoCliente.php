<?php

namespace App\Entity;

use App\Repository\PedidoClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoClienteRepository::class)]
class PedidoCliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pedidoClientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_creacion = null;

    #[ORM\Column]
    private ?float $total = null;

    /**
     * @var Collection<int, DetallePedidoCliente>
     */
    #[ORM\OneToMany(targetEntity: DetallePedidoCliente::class, mappedBy: 'pedido_cliente')]
    private Collection $detallePedidoClientes;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_confirmacion = null;

    public function __construct()
    {
        $this->detallePedidoClientes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): static
    {
        $this->fecha_creacion = $fecha_creacion;

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
     * @return Collection<int, DetallePedidoCliente>
     */
    public function getDetallePedidoClientes(): Collection
    {
        return $this->detallePedidoClientes;
    }

    public function addDetallePedidoCliente(DetallePedidoCliente $detallePedidoCliente): static
    {
        if (!$this->detallePedidoClientes->contains($detallePedidoCliente)) {
            $this->detallePedidoClientes->add($detallePedidoCliente);
            $detallePedidoCliente->setPedidoCliente($this);
        }

        return $this;
    }

    public function removeDetallePedidoCliente(DetallePedidoCliente $detallePedidoCliente): static
    {
        if ($this->detallePedidoClientes->removeElement($detallePedidoCliente)) {
            // set the owning side to null (unless already changed)
            if ($detallePedidoCliente->getPedidoCliente() === $this) {
                $detallePedidoCliente->setPedidoCliente(null);
            }
        }

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechaConfirmacion(): ?\DateTimeInterface
    {
        return $this->fecha_confirmacion;
    }

    public function setFechaConfirmacion(?\DateTimeInterface $fecha_confirmacion): static
    {
        $this->fecha_confirmacion = $fecha_confirmacion;

        return $this;
    }
}
