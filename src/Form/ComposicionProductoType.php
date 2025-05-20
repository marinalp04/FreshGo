<?php
namespace App\Form;

use App\Entity\ComposicionProducto;
use App\Entity\Ingrediente;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComposicionProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingrediente', EntityType::class, [
                'class' => Ingrediente::class,
                 'choice_label' => function (Ingrediente $ingrediente) {
                    return $ingrediente->getNombre() . ' (' . $ingrediente->getUnidadMedida()->getUnidadAbreviada() . ')';
                },
                'placeholder' => 'Selecciona un ingrediente',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                            ->orderBy('i.nombre', 'ASC');
                },
            ])
            ->add('cantidadNecesaria', IntegerType::class, [
                'attr' => ['min' => 1],
                 'label' => 'Cantidad necesaria',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ComposicionProducto::class,
        ]);
    }
}
