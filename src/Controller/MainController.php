<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    { 
        return $this->render('index.html.twig');
    }


    #[Route('/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Obtiene el último nombre de usuario y el error de autenticación
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
    
        // Cambiar la ruta del archivo Twig
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
        

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
    throw new \Exception('No debería ejecutarse este código.');
    }
}
