<?php

namespace App\DataFixtures;

use App\Entity\ComposicionProducto;
use App\Entity\Ingrediente;
use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ComposicionProductoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $composicion_producto1 = new ComposicionProducto();
        $composicion_producto1->setProducto($this->getReference('producto1', Producto::class));
        $composicion_producto1->setIngrediente($this->getReference('ingrediente1', Ingrediente::class));
        $composicion_producto1->setCantidadNecesaria(100);
        $manager->persist($composicion_producto1);

        $composicion_producto2 = new ComposicionProducto();
        $composicion_producto2->setProducto($this->getReference('producto2', Producto::class));
        $composicion_producto2->setIngrediente($this->getReference('ingrediente2', Ingrediente::class));
        $composicion_producto2->setCantidadNecesaria(200);
        $manager->persist($composicion_producto2);

        $composicion_producto3 = new ComposicionProducto();
        $composicion_producto3->setProducto($this->getReference('producto1', Producto::class));
        $composicion_producto3->setIngrediente($this->getReference('ingrediente2', Ingrediente::class));
        $composicion_producto3->setCantidadNecesaria(300);
        $manager->persist($composicion_producto3);


        $manager->flush();
       
    }
    public function getDependencies() : array
    {
        return [
            ProductoFixtures::class,
            IngredienteFixtures::class // Asegura que GenreFixtures se ejecute antes
        ];
    }
}
