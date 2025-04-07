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
        $manager->persist($categoria1);

        $categoria2 = new Categoria();
        $categoria2->setNombre('Platos proteicos');
        $manager->persist($categoria2);

        

        $manager->flush();

        $this->addReference('categoria1', $categoria1);
        $this->addReference('categoria2', $categoria2);
       
    }
}
