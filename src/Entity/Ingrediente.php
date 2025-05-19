<?php

namespace App\Entity;

use App\Repository\IngredienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['nombre'], message: 'Ya existe un ingrediente con este nombre.')]
#[ORM\Entity(repositoryClass: IngredienteRepository::class)]
class Ingrediente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'ingredientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UnidadMedida $unidad_medida = null;

    #[ORM\Column]
    private ?float $stock = null;

    /**
     * @var Collection<int, ComposicionProducto>
     */
    #[ORM\OneToMany(targetEntity: ComposicionProducto::class, mappedBy: 'ingrediente')]
    private Collection $composicionProductos;

    public function __construct()
    {
        $this->composicionProductos = new ArrayCollection();
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

    public function getUnidadMedida(): ?UnidadMedida
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(?UnidadMedida $unidad_medida): static
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): static
    {
        $this->stock = $stock;

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
            $composicionProducto->setIngrediente($this);
        }

        return $this;
    }

    public function removeComposicionProducto(ComposicionProducto $composicionProducto): static
    {
        if ($this->composicionProductos->removeElement($composicionProducto)) {
            // set the owning side to null (unless already changed)
            if ($composicionProducto->getIngrediente() === $this) {
                $composicionProducto->setIngrediente(null);
            }
        }

        return $this;
    }
}
