<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['nombre'], message: 'Ya existe un producto con este nombre.')]
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

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: FotoProducto::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $fotos;

    

    #[ORM\ManyToOne(inversedBy: 'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $categoria = null;

    /**
     * @var Collection<int, DetallePedidoCliente>
     */
    #[ORM\OneToMany(targetEntity: DetallePedidoCliente::class, mappedBy: 'producto')]
    private Collection $detallePedidoClientes;

    
    /**
     * @var Collection<int, ComposicionProducto>
     */
    #[ORM\OneToMany(targetEntity: ComposicionProducto::class, mappedBy: 'producto', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $composicionProductos;

    /**
     * @var Collection<int, FotoProducto>
     */
    #[ORM\OneToMany(targetEntity: FotoProducto::class, mappedBy: 'producto')]
    private Collection $fotoProductos;

    #[ORM\Column]
    private ?bool $activo = null;

    public function __construct()
    {
        $this->detallePedidoClientes = new ArrayCollection();
        $this->composicionProductos = new ArrayCollection();
        $this->fotoProductos = new ArrayCollection();
        $this->fotos = new ArrayCollection();
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
     * @return Collection<int, ComposicionProducto>
     */
    public function getComposicionProductos(): Collection
    {
        return $this->composicionProductos;
    }

    public function addComposicionProducto(ComposicionProducto $composicionProducto): static
    {
        if (!$this->composicionProductos->contains($composicionProducto)) {
            $this->composicionProductos->add($composicionProducto);
            $composicionProducto->setProducto($this);
        }

        return $this;
    }

    public function removeComposicionProducto(ComposicionProducto $composicionProducto): static
    {
        if ($this->composicionProductos->removeElement($composicionProducto)) {
            // set the owning side to null (unless already changed)
            if ($composicionProducto->getProducto() === $this) {
                $composicionProducto->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FotoProducto>
     */
    public function getFotoProductos(): Collection
    {
        return $this->fotoProductos;
    }

    public function addFotoProducto(FotoProducto $fotoProducto): static
    {
        if (!$this->fotoProductos->contains($fotoProducto)) {
            $this->fotoProductos->add($fotoProducto);
            $fotoProducto->setProducto($this);
        }

        return $this;
    }

    public function removeFotoProducto(FotoProducto $fotoProducto): static
    {
        if ($this->fotoProductos->removeElement($fotoProducto)) {
            // set the owning side to null (unless already changed)
            if ($fotoProducto->getProducto() === $this) {
                $fotoProducto->setProducto(null);
            }
        }

        return $this;
    }

    public function getPrimeraFoto(): ?FotoProducto
    {
        return $this->getFotoProductos()->first() ?: null;
    }

    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(FotoProducto $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setProducto($this);
        }

        return $this;
    }

    public function removeFoto(FotoProducto $foto): self
    {
        if ($this->fotos->removeElement($foto)) {
            if ($foto->getProducto() === $this) {
                $foto->setProducto(null);
            }
        }

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

}
