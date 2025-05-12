<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategoriaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categoria::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nombre', 'Nombre'),
            TextareaField::new('descripcion', 'Descripción'),
            BooleanField::new('destacada', 'Destacada'),
            ImageField::new('foto', 'Foto')
                ->setUploadDir('public/uploads/fotos_categorias/')
                ->setBasePath('uploads/foto_categorias/')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired($pageName === 'new'),
        ];
    }
    
}
