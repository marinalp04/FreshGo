<?php

namespace App\Controller\Admin;

use App\Entity\Ingrediente;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
        $ingrediente = $context->getEntity()->getInstance();
        $composiciones = $ingrediente->getComposicionProductos(); 

        return $this->render('admin/ingrediente/confirm_delete.html.twig', [
            'ingrediente' => $ingrediente,
            'composiciones' => $composiciones,
        ]);
    }

    #[Route('/admin/ingrediente/{id}/delete', name: 'admin_ingrediente_delete')]
    public function deleteIfNoComposiciones(
        int $id,
        EntityManagerInterface $em,
        AdminUrlGenerator $adminUrlGenerator
    ): Response {
        $ingrediente = $em->getRepository(Ingrediente::class)->find($id);

        if (!$ingrediente) {
            $this->addFlash('danger', 'Ingrediente no encontrado.');
        } elseif (count($ingrediente->getComposicionProductos()) > 0) {
            $this->addFlash('warning', 'No se puede eliminar un ingrediente que esté en uso en algún producto.');
        } else {
            $em->remove($ingrediente);
            $em->flush();
            $this->addFlash('success', 'Ingrediente eliminado correctamente.');
        }

        $url = $adminUrlGenerator
            ->setController(IngredienteCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }


    
}
