<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;
use Symfony\Component\Routing\Annotation\Route;

#[AttributeIsGranted('ROLE_ADMIN')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FreshGo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'); 
        yield MenuItem::linkToUrl('Volver a la web', 'fas fa-arrow-left', $this->generateUrl('app_home'));
        yield MenuItem::linkToCrud('Productos', 'fas fa-carrot', Producto::class);
        yield MenuItem::linkToCrud('Categorias', 'fas fa-tags', Categoria::class);
        yield MenuItem::linkToUrl('Usuarios', 'fas fa-users', $this->generateUrl('usuarios_index'));
    }
}
