<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{

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

    #[Route('/registro', name: 'app_registro')]
    public function registro(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $usuario = new Usuario();
            $usuario->setNombre($request->request->get('nombre'));
            $usuario->setApellidos($request->request->get('apellidos'));
            $usuario->setEmail($request->request->get('email'));
            $usuario->setContrasena($request->request->get('contrasena')); 
            $usuario->setDireccion($request->request->get('direccion'));
            $usuario->setTelefono((int) $request->request->get('telefono'));
            $usuario->setRol(0); 

            $entityManager->persist($usuario);
            $entityManager->flush();

            
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registro/index.html.twig');
    }
}
