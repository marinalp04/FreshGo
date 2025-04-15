<?php
// src/Form/RegistrationType.php
namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El nombre no puede estar vacío.']),
                ],
            ])
            ->add('apellidos', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Los apellidos no pueden estar vacíos.']),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El email no puede estar vacío.']),
                    new Email(['message' => 'Por favor, ingrese un email válido.']),
                ],
            ])
            ->add('contrasena', PasswordType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La contraseña no puede estar vacía.']),
                ],
            ])
            ->add('direccion', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La dirección no puede estar vacía.']),
                ],
            ])
            ->add('telefono', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El teléfono no puede estar vacío.']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrarse',
            ]);
    }
}
