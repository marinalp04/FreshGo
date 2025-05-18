<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use App\Entity\Ingrediente;
use App\Entity\PedidoCliente;
use App\Entity\Producto;
use App\Entity\UnidadMedida;
use App\Entity\Usuario;
use App\Repository\CategoriaRepository;
use App\Repository\PedidoClienteRepository;
use App\Repository\ProductoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;
use Symfony\Component\Routing\Annotation\Route;


#[AttributeIsGranted('ROLE_ADMIN_GENERAL')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    private UsuarioRepository $usuarioRepo;
    private ProductoRepository $productoRepo;
    private PedidoClienteRepository $pedidoRepo;
    private CategoriaRepository $categoriaRepo;
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(
        UsuarioRepository $usuarioRepo,
        ProductoRepository $productoRepo,
        PedidoClienteRepository $pedidoRepo,
        CategoriaRepository $categoriaRepo,
        AdminUrlGenerator $adminUrlGenerator
    ) {
        $this->usuarioRepo = $usuarioRepo;
        $this->productoRepo = $productoRepo;
        $this->pedidoRepo = $pedidoRepo;
        $this->categoriaRepo = $categoriaRepo;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $totalUsuarios = $this->usuarioRepo->count([]);
        $totalProductosActivos = $this->productoRepo->count(['activo' => true]);
        $totalPedidos = $this->pedidoRepo->count([]);
        $totalCategoriasActivas = $this->categoriaRepo->count(['activo' => true]);

        $crearProductoUrl = $this->adminUrlGenerator
            ->setController(\App\Controller\Admin\ProductoCrudController::class)
            ->setAction('new')
            ->generateUrl();

        $crearCategoriaUrl = $this->adminUrlGenerator
            ->setController(\App\Controller\Admin\CategoriaCrudController::class)
            ->setAction('new')
            ->generateUrl();


        return $this->render('admin/dashboard.html.twig', [
            'totalUsuarios' => $totalUsuarios,
            'totalProductosActivos' => $totalProductosActivos,
            'totalPedidos' => $totalPedidos,
            'totalCategoriasActivas' => $totalCategoriasActivas,
            'crearProductoUrl' => $crearProductoUrl,
            'crearCategoriaUrl' => $crearCategoriaUrl,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FreshGo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Volver a la web', 'fas fa-arrow-left', $this->generateUrl('app_home'));
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'); 
       

        if ($this->isGranted('ROLE_ADMIN_READONLY') || $this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Categorias', 'fas fa-tags', Categoria::class);
            yield MenuItem::linkToCrud('Productos', 'fas fa-utensils', Producto::class);
            yield MenuItem::linkToCrud('Pedidos', 'fas fa-shopping-cart', PedidoCliente::class);
            yield MenuItem::linkToCrud('Unidades de Medida', 'fas fa-balance-scale', UnidadMedida::class);
            yield MenuItem::linkToCrud('Ingredientes', 'fas fa-carrot', Ingrediente::class);
        }

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToUrl('Usuarios', 'fas fa-users', $this->generateUrl('usuarios_index'));
        }
    }
}
