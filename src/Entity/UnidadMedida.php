<?php

namespace App\Entity;

use App\Repository\UnidadMedidaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['nombre'], message: 'Ya existe una unidad de medida con este nombre.')]
#[ORM\Entity(repositoryClass: UnidadMedidaRepository::class)]
class UnidadMedida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Ingrediente>
     */
    #[ORM\OneToMany(targetEntity: Ingrediente::class, mappedBy: 'unidad_medida')]
    private Collection $ingredientes;

    #[ORM\Column(length: 255)]
    private ?string $unidad_abreviada = null;

    public function __construct()
    {
        $this->ingredientes = new ArrayCollection();
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

    /**
     * @return Collection<int, Ingrediente>
     */
    public function getIngredientes(): Collection
    {
        return $this->ingredientes;
    }

    public function addIngrediente(Ingrediente $ingrediente): static
    {
        if (!$this->ingredientes->contains($ingrediente)) {
            $this->ingredientes->add($ingrediente);
            $ingrediente->setUnidadMedida($this);
        }

        return $this;
    }

    public function removeIngrediente(Ingrediente $ingrediente): static
    {
        if ($this->ingredientes->removeElement($ingrediente)) {
            // set the owning side to null (unless already changed)
            if ($ingrediente->getUnidadMedida() === $this) {
                $ingrediente->setUnidadMedida(null);
            }
        }

        return $this;
    }

    public function getUnidadAbreviada(): ?string
    {
        return $this->unidad_abreviada;
    }

    public function setUnidadAbreviada(string $unidad_abreviada): static
    {
        $this->unidad_abreviada = $unidad_abreviada;

        return $this;
    }

    public function __toString(): string
    {
        return $this->unidad_abreviada;
    }
}
