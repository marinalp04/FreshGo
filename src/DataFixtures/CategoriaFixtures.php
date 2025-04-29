<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $categoria1 = new Categoria();
        $categoria1->setNombre('Platos vegetarianos');
        $categoria1->setDescripcion('Platos a base de ingredientes vegetales, ideales para vegetarianos y veganos.');
        $categoria1->setFoto('vegetarianos.jpg');
        $manager->persist($categoria1);

        $categoria2 = new Categoria();
        $categoria2->setNombre('Platos proteicos');
        $categoria2->setDescripcion('Platos ricos en proteínas, ideales para quienes buscan aumentar su masa muscular.');
        $categoria2->setFoto('proteicos.jpg');
        $manager->persist($categoria2);

        

        $manager->flush();

        $this->addReference('categoria1', $categoria1);
        $this->addReference('categoria2', $categoria2);
       
    }
}
