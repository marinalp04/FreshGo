<?php

namespace App\DataFixtures;

use App\Entity\UnidadMedida;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UnidadMedidaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $unidad_medida1 = new UnidadMedida();
        $unidad_medida1->setNombre("mililitros");
        $unidad_medida1->setUnidadAbreviada("ml");
        $manager->persist($unidad_medida1);

        $unidad_medida2 = new UnidadMedida();
        $unidad_medida2->setNombre("gramos");
        $unidad_medida2->setUnidadAbreviada("gr");
        $manager->persist($unidad_medida2);

       

        $manager->flush();

        $this->addReference('unidad_medida1', $unidad_medida1);
        $this->addReference('unidad_medida2', $unidad_medida2);
    }
}
