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
use Symfony\Component\Form\CallbackTransformer;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'];
        $showRoles = $options['show_roles'];

        $builder
            ->add('nombre', null, [
                'attr' => ['class' => 'form-control'],
            ])  
            ->add('apellidos' , null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
                'disabled' => $isEdit,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('direccion' , null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('telefono' , null, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'mapped' => false, 
                'required' => !$isEdit, 
                'attr' => [
                    'placeholder' => $isEdit ? 'Nueva contraseña (opcional)' : '',
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
            ]);

        if ($showRoles) {
            $builder
             ->add('activo', CheckboxType::class, [
                'label' => 'Usuario activo',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Usuario normal (sin permisos adicionales)' => '',
                    'Admin Lectura' => 'ROLE_ADMIN_READONLY',
                    'Admin' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Rol asignado',
                'attr' => ['class' => 'form-check'],
            ]);

            // Transformar el campo de roles para que lo guarde como un array
            $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                // de array (base de datos) a string (formulario)
                return $rolesArray[0] ?? null;
            },
            function ($roleString) {
                // de string (formulario) a array (entidad)
                return [$roleString];
            }
            ));
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'is_edit' => false,
            'show_roles' => true,
        ]);
    }
}
