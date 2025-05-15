<?php
namespace App\Service;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioManager
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    public function crearUsuario(Usuario $usuario, string $plainPassword): void
    {
        //Para encriptar password
        $hashedPassword = $this->passwordHasher->hashPassword(
            $usuario,
            $plainPassword
        );
        $usuario->setPassword($hashedPassword);

        //Asegurar que al menos tenga ROLE_USER
        $roles = $usuario->getRoles();
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
            $usuario->setRoles($roles);
        }

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();
    }
}
