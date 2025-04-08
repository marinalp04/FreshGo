<?php

namespace App\DataFixtures;

use App\Entity\FotoProducto;
use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FotoProductoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $foto_producto1 = new FotoProducto();
        $foto_producto1->setProducto($this->getReference('producto1', Producto::class));
        $foto_producto1->setFoto('foto1.jpg');
        $manager->persist($foto_producto1);

        $foto_producto2 = new FotoProducto();
        $foto_producto2->setProducto($this->getReference('producto2', Producto::class));
        $foto_producto2->setFoto('foto2.jpg');
        $manager->persist($foto_producto2);


        $manager->flush();
    }
    public function getDependencies() : array
    {
        return [
            ProductoFixtures::class, // Asegura que GenreFixtures se ejecute antes
        ];
    }
}
