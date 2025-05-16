<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Este email ya está registrado.')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    #[Assert\NotBlank(message: "El email no puede estar vacío.")]
    #[Assert\Email(message: "Por favor, ingrese un email válido.")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column]
    private ?int $telefono = null;

    /**
     * @var Collection<int, PedidoCliente>
     */
    #[ORM\OneToMany(targetEntity: PedidoCliente::class, mappedBy: 'usuario')]
    private Collection $pedidoClientes;

    #[ORM\Column]
    private array $roles = [];

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

     // Métodos de UserInterface

     public function getUserIdentifier(): string
     {
         return (string) $this->email;
     }

     public function getSalt(): ?string
     {
        //No lo necesito por ahora
         return null;
     }
 
     public function eraseCredentials(): void
     {
         // Borra cualquier dato sensible como contraseñas sin cifrar, no lo necesito por ahora
     }

     public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

     public function setRoles(array $roles): static
     {
         $this->roles = $roles;

         return $this;
     }

      public function __toString(): string
    {
        return $this->email;
    }
    
}
