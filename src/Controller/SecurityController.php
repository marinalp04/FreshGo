<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Security\UsuarioAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Form\RegistrationType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SecurityController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {
        // Constructor
    }
    // #[Route('/login', name: 'app_login')]
    // public function loginBackup(Request $request, AuthenticationUtils $authenticationUtils): Response
    // {
    //     // Obtiene el último nombre de usuario y el error de autenticación
    //     $lastUsername = $authenticationUtils->getLastUsername();
    //     $error = $authenticationUtils->getLastAuthenticationError();

    //     // Cambiar la ruta del archivo Twig
    //     return $this->render('login/index.html.twig', [
    //         'last_username' => $lastUsername,
    //         'error' => $error,
    //     ]);
    // }

    // #[Route('/logout', name: 'app_logout')]
    // public function logoutBackup(): void
    // {
    //     throw new \Exception('No debería ejecutarse este código.');
    // }

    #[Route('/registro', name: 'app_registro')]
    public function registro(
        Request $request,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        UsuarioAuthenticator $authenticator,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $usuario = new Usuario();

        $form = $this->createForm(RegistrationType::class, $usuario);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Para encriptar la contraseña
            $hashedPassword = $passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($hashedPassword);
            // Para asignar rol por defecto
            $usuario->setRol(0);

            $entityManager->persist($usuario);
            $entityManager->flush();
            
            //Autenticar al usuario automaticamente después de registrarse
            return $userAuthenticator->authenticateUser(
                $usuario,
                $authenticator,
                $request
            );
        }
    
        return $this->render('registro/index.html.twig', [
            'form' => $form->createView(), 
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
