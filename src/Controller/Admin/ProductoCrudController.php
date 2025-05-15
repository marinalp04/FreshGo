<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use App\Form\FotoProductoType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField ::new('id')->onlyOnIndex(),
            TextField::new('nombre'),
            TextField::new('descripcion'),
            MoneyField::new('precio')
            ->setCurrency('EUR')
            ->setStoredAsCents(false),
            AssociationField::new('categoria'),
            BooleanField::new('activo', 'Activo'),
            CollectionField::new('fotos')
            ->setEntryType(FotoProductoType::class)
            ->onlyOnForms()
            ->allowAdd()
            ->allowDelete()
            ->setFormTypeOptions(['by_reference' => false]),
        ];
    }
    
}
