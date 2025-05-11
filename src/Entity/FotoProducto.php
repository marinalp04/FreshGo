<?php

namespace App\Entity;

use App\Repository\FotoProductoRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FotoProductoRepository::class)]
#[Vich\Uploadable]
class FotoProducto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fotoProductos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $producto = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'foto')]
    private ?File $fotoFile = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function setFotoFile(?File $fotoFile = null): void
    {
        $this->fotoFile = $fotoFile;

        if ($fotoFile !== null) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFotoFile(): ?File
    {
        return $this->fotoFile;
    }

    public function __toString(): string
    {
        return $this->foto ?? 'Sin imagen';
    }
}
