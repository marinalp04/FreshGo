<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nombre'),
            TextField::new('descripcion'),
            MoneyField::new('precio')->setCurrency('EUR'),
            AssociationField::new('categoria'),
        ];
    }
    
}
