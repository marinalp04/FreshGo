<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use App\Form\ComposicionProductoType;
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
use App\Repository\DetallePedidoClienteRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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

            // Para insertar las imagenes en fotoProducto
            CollectionField::new('fotos')
            ->setEntryType(FotoProductoType::class)
            ->onlyOnForms()
            ->allowAdd()
            ->allowDelete()
            ->setFormTypeOptions(['by_reference' => false]),

            //Para insertar los ingredientes en su composicion
            CollectionField::new('composicionProductos', 'Ingredientes del producto')
            ->setEntryType(ComposicionProductoType::class)
            ->allowAdd()
            ->allowDelete()
            ->setFormTypeOptions(['by_reference' => false])
            ->onlyOnForms(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $customDelete = Action::new('confirmDelete', 'Eliminar')
            ->linkToCrudAction('confirmDelete')
            ->setCssClass('btn btn-danger');

        return $actions
            ->add(Crud::PAGE_INDEX, $customDelete)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function confirmDelete(AdminContext $context, DetallePedidoClienteRepository $detallePedidoRepo): Response
    {
        $producto = $context->getEntity()->getInstance();
        $pedidos = $detallePedidoRepo->findBy(['producto' => $producto]);

        return $this->render('admin/producto/confirm_delete.html.twig', [
            'producto' => $producto,
            'pedidos' => $pedidos,
        ]);
    }

    #[Route('/admin/producto/{id}/delete', name: 'admin_producto_delete')]
    public function deleteIfNoPedidos(int $id, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator, DetallePedidoClienteRepository $detallePedidoRepo): Response
    {
        $producto = $em->getRepository(Producto::class)->find($id);

        if (!$producto) {
            $this->addFlash('danger', 'Producto no encontrado.');
        } elseif (count($detallePedidoRepo->findBy(['producto' => $producto])) > 0) {
            $this->addFlash('warning', 'No se puede eliminar un producto que esté en pedidos.');
        } else {
            // Borrar relaciones con ingredientes
            foreach ($producto->getComposicionProductos() as $composicion) {
                $em->remove($composicion);
            }

            $em->remove($producto);
            $em->flush();

            $this->addFlash('success', 'Producto eliminado correctamente.');
        }

        $url = $adminUrlGenerator
            ->setController(ProductoCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    
}
