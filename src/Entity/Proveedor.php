<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    /**
     * @var Collection<int, PedidoProveedor>
     */
    #[ORM\OneToMany(targetEntity: PedidoProveedor::class, mappedBy: 'proveedor')]
    private Collection $pedidoProveedors;

    public function __construct()
    {
        $this->pedidoProveedors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return Collection<int, PedidoProveedor>
     */
    public function getPedidoProveedors(): Collection
    {
        return $this->pedidoProveedors;
    }

    public function addPedidoProveedor(PedidoProveedor $pedidoProveedor): static
    {
        if (!$this->pedidoProveedors->contains($pedidoProveedor)) {
            $this->pedidoProveedors->add($pedidoProveedor);
            $pedidoProveedor->setProveedor($this);
        }

        return $this;
    }

    public function removePedidoProveedor(PedidoProveedor $pedidoProveedor): static
    {
        if ($this->pedidoProveedors->removeElement($pedidoProveedor)) {
            // set the owning side to null (unless already changed)
            if ($pedidoProveedor->getProveedor() === $this) {
                $pedidoProveedor->setProveedor(null);
            }
        }

        return $this;
    }
}
