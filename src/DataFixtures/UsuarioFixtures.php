<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UsuarioFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
       
        $usuario1 = new Usuario();
        $usuario1->setNombre('Marina');
        $usuario1->setApellidos('Lopez Arriaga');
        $usuario1->setEmail('mloparr@gmail.com');
        $usuario1->setPassword('1234');
        $usuario1->setDireccion('Calle de la Paz, 123');
        $usuario1->setTelefono('123456789');
        $usuario1->setRol('0');
        $manager->persist($usuario1);

        

        $manager->flush();

        $this->addReference('usuario1', $usuario1);
       
    }

    
    
}
