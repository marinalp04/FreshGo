<?php
namespace App\Security;

use App\Entity\Usuario;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof Usuario) {
            return;
        }

        if (!$user->isActivo()) {
            throw new CustomUserMessageAccountStatusException('Tu cuenta está desactivada. Contacta con el administrador.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        
    }
}
