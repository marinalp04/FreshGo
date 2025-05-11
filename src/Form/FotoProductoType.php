<?php
// src/Form/FotoProductoType.php

namespace App\Form;

use App\Entity\FotoProducto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FotoProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fotoFile', VichImageType::class, [
                'label' => 'Subir imagen',
                'required' => false,
                'download_uri' => true,
                'allow_delete' => true,
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FotoProducto::class,
        ]);
    }
}
