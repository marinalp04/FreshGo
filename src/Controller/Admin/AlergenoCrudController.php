<?php

namespace App\Controller\Admin;

use App\Entity\Alergeno;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\SecurityBundle\Security;

class AlergenoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alergeno::class;
    }

    public function __construct(private Security $security) {
        
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nombre'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if ($this->security->isGranted('ROLE_ADMIN_READONLY') && 
            !$this->security->isGranted('ROLE_ADMIN')) {
            
            return $actions
                ->disable(Action::NEW, Action::EDIT, Action::DELETE);
        }
        return $actions;
    }

    
}
