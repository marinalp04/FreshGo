<?php

namespace App\Controller\Admin;

use App\Entity\PedidoCliente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\DetallePedidoClienteType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class PedidoClienteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PedidoCliente::class;
    }

    public function configureFields(string $pageName): iterable
    { 
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('usuario', 'Cliente'),
            DateTimeField::new('fechaCreacion'),
            DateTimeField::new('fechaConfirmacion')->hideOnIndex(),
            TextField::new('estado'),
            MoneyField::new('total')->setCurrency('EUR'),
            CollectionField::new('detalles', 'Detalles del pedido')
                ->setEntryType(DetallePedidoClienteType::class)
                ->onlyOnForms()
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions(['by_reference' => false]),
        ];
    }
    
}
