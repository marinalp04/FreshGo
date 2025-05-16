<?php

namespace App\Controller\Admin;

use App\Entity\UnidadMedida;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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

    public function configureActions(Actions $actions): Actions
    {
         $customDelete = Action::new('confirmDelete', 'Eliminar')
            ->linkToCrudAction('confirmDelete')
            ->setCssClass('btn btn-danger');

        return $actions
            ->add(Crud::PAGE_INDEX, $customDelete)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function confirmDelete(AdminContext $context): Response
    {
        $unidad = $context->getEntity()->getInstance();
        $ingredientes = $unidad->getIngredientes();

        return $this->render('admin/unidad_medida/confirm_delete.html.twig', [
            'unidad' => $unidad,
            'ingredientes' => $ingredientes,
        ]);
    }

    #[Route('/admin/unidad-medida/{id}/delete', name: 'admin_unidad_medida_delete')]
    public function deleteIfNoIngredientes(
        int $id, 
        EntityManagerInterface $em, 
        AdminUrlGenerator $adminUrlGenerator
    ): Response {
        $unidad = $em->getRepository(UnidadMedida::class)->find($id);

        if (!$unidad) {
            $this->addFlash('danger', 'Unidad de medida no encontrada.');
        } elseif (count($unidad->getIngredientes()) > 0) {
            $this->addFlash('warning', 'No se puede eliminar una unidad de medida con ingredientes asociados.');
        } else {
            $em->remove($unidad);
            $em->flush();
            $this->addFlash('success', 'Unidad de medida eliminada correctamente.');
        }

        $url = $adminUrlGenerator
            ->setController(UnidadMedidaCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }
    
}
