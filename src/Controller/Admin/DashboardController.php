<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Deal;
use App\Entity\Products;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator ;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
         // redirige vers un contrôleur CRUD
         $routeBuilder = $this->get(AdminUrlGenerator::class);

         return $this->redirect($routeBuilder->setController(ProductsCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EcoV');
    }

    // public function configureAssets(): Assets
    // {
    //     return Assets::new()->addCssFile('css/admin.css');
    // }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Site', 'far fa-window-maximize', '/');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Users::class);
        yield MenuItem::linkToCrud('Catégrories', 'fas fa-list-alt', Categories::class);
        yield MenuItem::linkToCrud('Type de vente', 'far fa-list-alt', Deal::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-book', Products::class);
        yield MenuItem::linkToLogout('Deconnexion', 'fas fa-sign-out-alt', 'app_logout');
    }
}
