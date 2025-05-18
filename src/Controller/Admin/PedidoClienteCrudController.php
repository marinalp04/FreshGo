<?php

namespace App\Controller\Admin;

use App\Entity\PedidoCliente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\DetallePedidoClienteType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;


class PedidoClienteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PedidoCliente::class;
    }

    public function __construct(private Security $security) {
        
    }

    public function configureFields(string $pageName): iterable
    { 
        //Para la vista de edicion
        if ($pageName === Crud::PAGE_EDIT) {
            return [
                IdField::new('id')->hideOnForm(),
                AssociationField::new('usuario', 'Cliente')->setDisabled(),
                DateTimeField::new('fechaCreacion')->setDisabled(),
                DateTimeField::new('fechaConfirmacion')->setDisabled(),
                TextField::new('estado'),
                MoneyField::new('total')->setDisabled()
                ->setCurrency('EUR')
                ->setStoredAsCents(false),

                CollectionField::new('detallePedidoClientes', 'Detalles del pedido')->setDisabled()
                    ->setEntryType(DetallePedidoClienteType::class)
                    ->onlyOnForms()
                    ->allowAdd()
                    ->allowDelete()
                    ->setFormTypeOptions(['by_reference' => false]),
            ];
        }

        //Para la vista de detalle
        if ($pageName === Crud::PAGE_EDIT) {
            return [
                IdField::new('id')->hideOnForm(),
                AssociationField::new('usuario', 'Cliente'),
                DateTimeField::new('fechaCreacion'),
                DateTimeField::new('fechaConfirmacion'),
                TextField::new('estado'),
                MoneyField::new('total')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),

                CollectionField::new('detallePedidoClientes', 'Detalles del pedido')
                    ->setEntryType(DetallePedidoClienteType::class)
                    ->onlyOnForms()
                    ->allowAdd()
                    ->allowDelete()
                    ->setFormTypeOptions(['by_reference' => false]),
            ];
        }
        //Para la vista de listado
         return [
                IdField::new('id')->hideOnForm(),
                AssociationField::new('usuario', 'Cliente'),
                DateTimeField::new('fechaCreacion'),
                DateTimeField::new('fechaConfirmacion'),
                TextField::new('estado'),
                MoneyField::new('total')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),

                CollectionField::new('detallePedidoClientes', 'Detalles del pedido')
                    ->setEntryType(DetallePedidoClienteType::class)
                    ->onlyOnForms()
                    ->allowAdd()
                    ->allowDelete()
                    ->setFormTypeOptions(['by_reference' => false]),
            ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if ($this->security->isGranted('ROLE_ADMIN_READONLY') && 
            !$this->security->isGranted('ROLE_ADMIN')) {
            
            return $actions
                ->disable(Action::NEW, Action::EDIT, Action::DELETE);
        }

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::NEW, Action::DELETE);
            
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Pedido')
            ->setEntityLabelInPlural('Pedidos')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Detalle del pedido')
            ->overrideTemplate('crud/detail', 'admin/pedido/show.html.twig');
    }

    
    // public function show(AdminContext $context, CrudUrlGenerator $crudUrlGenerator): Response
    // {
    //     return $this->render('admin/pedido/show.html.twig', [
    //         'entity' => $context->getEntity(),
    //         'crudUrlGenerator' => $crudUrlGenerator,
    //     ]);
    // }

    
}
