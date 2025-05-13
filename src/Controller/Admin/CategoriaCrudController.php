<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;


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
                ->setBasePath('uploads/fotos_categorias/')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired($pageName === 'new'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $confirmDelete = Action::new('confirmDelete', 'Eliminar (con productos)')
            ->linkToCrudAction('confirmDelete')
            ->addCssClass('btn btn-danger');

        return $actions
            ->add(Crud::PAGE_INDEX, $confirmDelete)
            ->disable(Action::DELETE);
    }

    public function confirmDelete(AdminContext $context): Response
    {
        $categoria = $context->getEntity()->getInstance();

        return $this->render('admin/categoria/confirm_delete.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    #[Route('/admin/categoria/{id}/force-delete', name: 'admin_categoria_force_delete')]
    public function forceDelete(int $id, EntityManagerInterface $entityManager, AdminUrlGenerator $adminUrlGenerator): Response
    {
        $categoria = $entityManager->getRepository(Categoria::class)->find($id);

        if (!$categoria) {
            $this->addFlash('danger', 'Categoría no encontrada.');
        } else {
            foreach ($categoria->getProductos() as $producto) {
                $entityManager->remove($producto);
            }

            $entityManager->remove($categoria);
            $entityManager->flush();

            $this->addFlash('success', 'Categoría y productos eliminados correctamente.');
        }

        //Redirigir al listado de categorías
        $url = $adminUrlGenerator
            ->setController(CategoriaCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }


}
