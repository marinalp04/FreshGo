<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Route('/admin/usuarios/{id}', name: 'usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('admin/usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }   

    #[Route('/admin/usuarios/{id}/edit', name: 'usuario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roles = $form->get('roles')->getData();
            if (!in_array('ROLE_USER', $roles)) {
                $roles[] = 'ROLE_USER';
            }
            $usuario->setRoles($roles);
            
            $entityManager->flush();

            $this->addFlash('success', 'Usuario actualizado correctamente.');

            return $this->redirectToRoute('usuarios_index');
        }

        return $this->render('admin/usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }   

   
}

