<?php

namespace App\Controller\Admin;

use App\Entity\Ingrediente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IngredienteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingrediente::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           IdField::new('id')->hideOnForm(),
            TextField::new('nombre'),
            IntegerField::new('stock'),
            AssociationField::new('unidad_medida', 'Unidad de Medida'),
        ];
    }
    
}
