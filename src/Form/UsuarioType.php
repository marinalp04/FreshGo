<?php
namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'];

        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
            ])
            ->add('direccion')
            ->add('telefono')
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'mapped' => false, 
                'required' => !$isEdit, 
                'attr' => [
                    'placeholder' => $isEdit ? 'Nueva contraseña (opcional)' : '',
                    'autocomplete' => 'new-password',
                ],
            ])
             ->add('activo', CheckboxType::class, [
                'label' => 'Usuario activo',
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Administrador' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Permisos adicionales',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'is_edit' => false,
        ]);
    }
}
