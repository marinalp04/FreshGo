<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioFixtures extends Fixture 
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}
    public function load(ObjectManager $manager): void
    {
       
        $usuario1 = new Usuario();
        $usuario1->setNombre('Marina');
        $usuario1->setApellidos('Lopez Arriaga');
        $usuario1->setEmail('mloparr@gmail.com');
        $usuario1->setPassword(
            $this->passwordHasher->hashPassword($usuario1, '1234')
        );
        $usuario1->setDireccion('Calle de la Paz, 123');
        $usuario1->setTelefono('123456789');
        $usuario1->setRoles(['ROLE_ADMIN']);
        $manager->persist($usuario1);

        $usuario2 = new Usuario();
        $usuario2->setNombre('Jose');
        $usuario2->setApellidos('Perez');
        $usuario2->setEmail('jose@gmail.com');
        $usuario2->setPassword(
            $this->passwordHasher->hashPassword($usuario2, '1234')
        );
        $usuario2->setDireccion('Calle de la Paz, 223');
        $usuario2->setTelefono('223456789');
        $usuario2->setRoles(['ROLE_USER']);
        $manager->persist($usuario2);

        

        $manager->flush();

        $this->addReference('usuario1', $usuario1);
       
    }

    
    
}
