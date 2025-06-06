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
use App\Service\UsuarioManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SecurityController extends AbstractController
{
    public function __construct() {
        // Constructor
    }

    #[Route('/registro', name: 'app_registro')]
    public function registro(
        Request $request,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        UsuarioAuthenticator $authenticator,
        UsuarioManager $usuarioManager
    ): Response {
        $usuario = new Usuario();

        $form = $this->createForm(RegistrationType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
            $usuarioManager->crearUsuario($usuario, $plainPassword);

            return $userAuthenticator->authenticateUser(
                $usuario,
                $authenticator,
                $request
            );
        }

        return $this->render('security/registro.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
         // Guardar redirectTo si viene en la URL
        $redirectTo = $request->query->get('redirectTo');
        if ($redirectTo) {
            $request->getSession()->set('_target_path', $redirectTo);
        }
        

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
