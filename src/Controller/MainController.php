<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(EntityManagerInterface $em): Response
    { 
        $categorias = $em->getRepository(Categoria::class)->findAll();

        return $this->render('index.html.twig', [
            'categorias' => $categorias,
        ]);
    }


    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/login/login.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
    throw new \Exception('No debería ejecutarse este código.');
    }
}
