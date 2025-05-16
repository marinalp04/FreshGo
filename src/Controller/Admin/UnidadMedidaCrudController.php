<?php

namespace App\Controller\Admin;

use App\Entity\UnidadMedida;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UnidadMedidaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UnidadMedida::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nombre', 'Nombre'),
            TextField::new('unidadAbreviada', 'Unidad Abreviada'),
        ];
    }
    
}
