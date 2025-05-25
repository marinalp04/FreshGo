<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use App\Service\UsuarioManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/admin/usuarios', name: 'usuarios_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $usuarios = $em->getRepository(Usuario::class)->findAll();

        return $this->render('admin/usuario/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }
    
     #[Route('/admin/usuarios/create', name: 'usuario_create')]
    public function create(Request $request, UsuarioManager $usuarioManager): Response
    {
        $usuario = new Usuario();

        $form = $this->createForm(UsuarioType::class, $usuario, [
            'is_edit' => false, 
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Recoger la pass manualmente
            $plainPassword = $form->get('password')->getData();

            $usuarioManager->crearUsuario($usuario, $plainPassword);

            return $this->redirectToRoute('usuarios_index');
        }

        return $this->render('admin/usuario/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/usuarios/{id}', name: 'usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('admin/usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }   

   
    
   #[Route('/admin/usuarios/{id}/edit', name: 'usuario_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        Usuario $usuario, 
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher 
    ): Response {
        $form = $this->createForm(UsuarioType::class, $usuario, [
            'is_edit' => true, 
            'show_roles' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roles = $form->get('roles')->getData();
            if (!in_array('ROLE_USER', $roles)) {
                $roles[] = 'ROLE_USER';
            }
            $usuario->setRoles($roles);

            // Procesar contraseña si se ha introducido una nueva 
            $plainPassword = $form->get('password')->getData();
            if (!empty($plainPassword)) {
                $hashedPassword = $userPasswordHasher->hashPassword($usuario, $plainPassword);
                $usuario->setPassword($hashedPassword);
            }

            $entityManager->flush();

            return $this->redirectToRoute('usuarios_index');
        }

        return $this->render('admin/usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

#[Route('/admin/usuarios/{id}/delete', name: 'usuario_delete', methods: ['POST'])]
public function delete(
    Request $request,
    Usuario $usuario,
    EntityManagerInterface $entityManager,
    Security $security
): Response {
    if ($this->isCsrfTokenValid('delete_usuario_' . $usuario->getId(), $request->request->get('_token'))) {

        /** @var \App\Entity\Usuario $currentUser */
        $currentUser = $security->getUser();

        // Si el usuario a borrar es el que está autenticado
        if ($currentUser && $currentUser->getId() === $usuario->getId()) {
            $this->addFlash('danger', 'No puedes eliminar tu propio usuario.');
        }
        //Si es SUPERADMIN
        elseif (in_array('ROLE_SUPERADMIN', $usuario->getRoles())) {
            $this->addFlash('danger', 'Este usuario tiene el rol SUPERADMIN. No puedes eliminarlo directamente. Puedes editarlo y quitarle ese rol si lo deseas.');
        }
        //Si tiene pedidos
        elseif (count($usuario->getPedidoClientes()) > 0) {
            $this->addFlash('warning', 'Este usuario tiene pedidos asociados y no puede eliminarse. Puedes desactivarlo desde la edición.');
        }
        //Si no, se elimina
        else {
            $entityManager->remove($usuario);
            $entityManager->flush();
            $this->addFlash('success', 'Usuario eliminado correctamente.');
        }
    }

    return $this->redirectToRoute('usuarios_index');
}


    #[Route('/admin/usuarios/{id}/confirm-delete', name: 'usuario_confirm_delete', methods: ['GET'])]
    public function confirmDelete(Usuario $usuario, EntityManagerInterface $em,  Security $security,): Response
    {
        $pedidos = $usuario->getPedidoClientes(); 
        $usuarios = $em->getRepository(Usuario::class)->findAll();
        $usuarioActual = $security->getUser();

        return $this->render('admin/usuario/confirm_delete.html.twig', [
            'usuario' => $usuario,
            'pedidos' => $pedidos,
            'usuarios' => $usuarios,
            'usuarioActual' => $usuarioActual,
        ]);
    }


   
}

