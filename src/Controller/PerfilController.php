<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/perfil')]
#[IsGranted('ROLE_USER')]
class PerfilController extends AbstractController
{
    #[Route('', name: 'app_perfil')]
    public function index(): Response
    {
        $usuario = $this->getUser();

        return $this->render('perfil/index.html.twig', [
            'usuario' => $usuario,
        ]);
    }
}
