<?php
namespace App\Controller;

use App\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    #[Route('/contacto', name: 'app_contacto')]
    public function contacto(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datos = $form->getData();

            $email = (new Email())
                ->from($datos['email'])
                ->to('freshandgo.pedidos@gmail.com')
                ->subject($datos['asunto'] ?: 'Nuevo mensaje de contacto')
                ->text(
                    "Nombre: {$datos['nombre']}\nEmail: {$datos['email']}\n\nMensaje:\n{$datos['mensaje']}"
                );

            $mailer->send($email);

            $this->addFlash('success', 'Tu mensaje ha sido enviado correctamente.');

            return $this->redirectToRoute('app_contacto');
        }

        return $this->render('contacto.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
