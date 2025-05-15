<?php

namespace App\Form;

use App\Entity\DetallePedidoCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Producto;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class DetallePedidoClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      $builder
            ->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'nombre',
                'label' => 'Producto',
            ])
            ->add('cantidad', IntegerType::class)
            ->add('precioUnitario', MoneyType::class, [
                'currency' => 'EUR',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => DetallePedidoCliente::class,
        ]);
    }
}
