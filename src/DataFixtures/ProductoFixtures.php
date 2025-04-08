<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $producto1 = new Producto();
        $producto1->setNombre('Ensalada César');
        $producto1->setDescripcion('Ensalada con pollo, lechuga y aderezo César.');
        $producto1->setPrecio(12.99);
        $producto1->setCategoria($this->getReference('categoria1', Categoria::class));
        $manager->persist($producto1);

        $producto2 = new Producto();
        $producto2->setNombre('Hamburguesa vegana');
        $producto2->setDescripcion('Hamburguesa hecha con garbanzos y especias.');
        $producto2->setPrecio(8.99);
        $producto2->setCategoria($this->getReference('categoria2', Categoria::class));
        $manager->persist($producto2);

        $manager->flush();

        $this->addReference('producto1', $producto1);
        $this->addReference('producto2', $producto2);
    }

    public function getDependencies() : array
    {
        return [
            CategoriaFixtures::class, 
        ];
    }
}
