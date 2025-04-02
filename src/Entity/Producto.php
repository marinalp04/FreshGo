<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $categoria = null;

    /**
     * @var Collection<int, DetallePedidoCliente>
     */
    #[ORM\OneToMany(targetEntity: DetallePedidoCliente::class, mappedBy: 'producto')]
    private Collection $detallePedidoClientes;

    /**
     * @var Collection<int, DetallePedidoProveedor>
     */
    #[ORM\OneToMany(targetEntity: DetallePedidoProveedor::class, mappedBy: 'producto')]
    private Collection $detallePedidoProveedors;

    public function __construct()
    {
        $this->detallePedidoClientes = new ArrayCollection();
        $this->detallePedidoProveedors = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

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
            $detallePedidoCliente->setProducto($this);
        }

        return $this;
    }

    public function removeDetallePedidoCliente(DetallePedidoCliente $detallePedidoCliente): static
    {
        if ($this->detallePedidoClientes->removeElement($detallePedidoCliente)) {
            // set the owning side to null (unless already changed)
            if ($detallePedidoCliente->getProducto() === $this) {
                $detallePedidoCliente->setProducto(null);
            }
        }

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
            $detallePedidoProveedor->setProducto($this);
        }

        return $this;
    }

    public function removeDetallePedidoProveedor(DetallePedidoProveedor $detallePedidoProveedor): static
    {
        if ($this->detallePedidoProveedors->removeElement($detallePedidoProveedor)) {
            // set the owning side to null (unless already changed)
            if ($detallePedidoProveedor->getProducto() === $this) {
                $detallePedidoProveedor->setProducto(null);
            }
        }

        return $this;
    }

    
}
