<?php
namespace App\Controller;

use App\Entity\PedidoCliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Usuario;
use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[IsGranted('ROLE_USER')]
class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(EntityManagerInterface $em): Response
    {
        $usuario = $this->getUser();

        $pedidos = $em->getRepository(PedidoCliente::class)->findBy(
            ['usuario' => $usuario, 'estado' => 'confirmado'],
            ['fecha_confirmacion' => 'DESC'],
        );

        return $this->render('perfil/index.html.twig', [
            'usuario' => $usuario,
            'pedidos' => $pedidos,
        ]);
    }

    #[Route('/perfil/editar', name: 'perfil_editar')]
    public function editar(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        /** @var \App\Entity\Usuario $usuario */
        $usuario = $this->getUser();

        $form = $this->createForm(UsuarioType::class, $usuario, [
            'is_edit' => true,
            'show_roles' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();

            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($usuario, $plainPassword);
                $usuario->setPassword($hashedPassword);
            }

            $em->flush();

            return $this->redirectToRoute('perfil_editar');
        }

        return $this->render('perfil/editar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/perfil/pedido/{id}', name: 'perfil_pedido_detalle')]
    public function verDetallePedido(PedidoCliente $pedido): Response
    {
        return $this->render('perfil/detalle_pedido.html.twig', [
            'pedido' => $pedido,
            'detalles' => $pedido->getDetallePedidoClientes(),
        ]);
    }


}
