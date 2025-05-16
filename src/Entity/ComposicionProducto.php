<?php

namespace App\Entity;

use App\Repository\ComposicionProductoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComposicionProductoRepository::class)]
class ComposicionProducto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'composicionProductos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $producto = null;

    #[ORM\ManyToOne(inversedBy: 'composicionProductos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingrediente $ingrediente = null;

    #[ORM\Column]
    private ?float $cantidad_necesaria = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngrediente(): ?Ingrediente
    {
        return $this->ingrediente;
    }

    public function setIngrediente(?Ingrediente $ingrediente): static
    {
        $this->ingrediente = $ingrediente;

        return $this;
    }

    public function getCantidadNecesaria(): ?float
    {
        return $this->cantidad_necesaria;
    }

    public function setCantidadNecesaria(float $cantidad_necesaria): static
    {
        $this->cantidad_necesaria = $cantidad_necesaria;

        return $this;
    }

    public function __toString(): string
    {
         return $this->getIngrediente()->getNombre() 
            . ': ' 
            . $this->getCantidadNecesaria() 
            . ' ' 
            . $this->getIngrediente()->getUnidadMedida()->getUnidadAbreviada();
    }

}

