<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $contrasena = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column]
    private ?int $telefono = null;

    #[ORM\Column]
    private ?int $rol = null;

    /**
     * @var Collection<int, PedidoCliente>
     */
    #[ORM\OneToMany(targetEntity: PedidoCliente::class, mappedBy: 'usuario')]
    private Collection $pedidoClientes;

    public function __construct()
    {
        $this->pedidoClientes = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

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

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): static
    {
        $this->contrasena = $contrasena;

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

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getRol(): ?int
    {
        return $this->rol;
    }

    public function setRol(int $rol): static
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection<int, PedidoCliente>
     */
    public function getPedidoClientes(): Collection
    {
        return $this->pedidoClientes;
    }

    public function addPedidoCliente(PedidoCliente $pedidoCliente): static
    {
        if (!$this->pedidoClientes->contains($pedidoCliente)) {
            $this->pedidoClientes->add($pedidoCliente);
            $pedidoCliente->setUsuario($this);
        }

        return $this;
    }

    public function removePedidoCliente(PedidoCliente $pedidoCliente): static
    {
        if ($this->pedidoClientes->removeElement($pedidoCliente)) {
            // set the owning side to null (unless already changed)
            if ($pedidoCliente->getUsuario() === $this) {
                $pedidoCliente->setUsuario(null);
            }
        }

        return $this;
    }

    
}
