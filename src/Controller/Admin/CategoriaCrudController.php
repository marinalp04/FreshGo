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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;


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
            BooleanField::new('activo', 'Activa'),
            ImageField::new('foto', 'Foto')
                ->setUploadDir('public/uploads/fotos_categorias/')
                ->setBasePath('uploads/fotos_categorias/')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired($pageName === 'new'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $confirmDelete = Action::new('confirmDelete', 'Eliminar')
            ->linkToCrudAction('confirmDelete')
            ->addCssClass('btn btn-danger');

        return $actions
            ->add(Crud::PAGE_INDEX, $confirmDelete)
            ->disable(Action::DELETE);
    }

    public function confirmDelete(AdminContext $context): Response
    {
        $categoria = $context->getEntity()->getInstance();
        $productos = $categoria->getProductos();

        return $this->render('admin/categoria/confirm_delete.html.twig', [
            'categoria' => $categoria,
            'productos' => $productos,
        ]);
    }

    #[Route('/admin/categoria/{id}/delete', name: 'admin_categoria_delete')]
    public function deleteIfNoProductos(int $id, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator): Response
    {
        $categoria = $em->getRepository(Categoria::class)->find($id);

        if (!$categoria) {
            
        } elseif (count($categoria->getProductos()) > 0) {
            $this->addFlash('warning', 'No se puede eliminar una categoría con productos asociados.');
        } else {
            $foto = $categoria->getFoto();
            if ($foto) {
                $ruta = $this->getParameter('kernel.project_dir') . '/public/uploads/fotos_categorias/' . $foto;
                $fs = new Filesystem();
                if ($fs->exists($ruta)) {
                    $fs->remove($ruta);
                }
            }

            $em->remove($categoria);
            $em->flush();

            $this->addFlash('success', 'Categoría eliminada correctamente.');
        }

        $url = $adminUrlGenerator
            ->setController(CategoriaCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }



   

    #[Route('/categoria/{id}/desactivar', name: 'categoria_desactivar')]
    public function desactivar(Categoria $categoria, EntityManagerInterface $em): Response
    {
        $categoria->setActivo(false);

        foreach ($categoria->getProductos() as $producto) {
            $producto->setActivo(false);
        }

        $em->flush();

        $this->addFlash('success', 'Categoría y productos desactivados correctamente.');
        return $this->redirectToRoute('categoria_index');
    }

}
