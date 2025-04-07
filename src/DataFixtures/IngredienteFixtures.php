<?php

namespace App\DataFixtures;

use App\Entity\Ingrediente;
use App\Entity\UnidadMedida;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredienteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ingrediente1 = new Ingrediente();
        $ingrediente1->setUnidadMedida($this->getReference('unidad_medida1', UnidadMedida::class));
        $ingrediente1->setNombre('leche');
        $ingrediente1->setStock(100);
        $manager->persist($ingrediente1);

        $ingrediente2 = new Ingrediente();
        $ingrediente2->setUnidadMedida($this->getReference('unidad_medida2', UnidadMedida::class));
        $ingrediente2->setNombre('pollo');
        $ingrediente2->setStock(200);
        $manager->persist($ingrediente2);

        $manager->flush();

        $this->addReference('ingrediente1', $ingrediente1);
        $this->addReference('ingrediente2', $ingrediente2);
    }
}
