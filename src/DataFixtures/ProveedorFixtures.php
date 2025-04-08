<?php

namespace App\DataFixtures;

use App\Entity\Proveedor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProveedorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $proveedor1 = new Proveedor();
        $proveedor1->setNombre('Juan Frutas SL');
        $proveedor1->setEmail('juan@gmail.com');
        $proveedor1->setDireccion('Calle de la Paz, 123');
        $proveedor1->setTelefono('123456789');
        $manager->persist($proveedor1);

        

        $manager->flush();

        $this->addReference('proveedor1', $proveedor1);
    }
}
