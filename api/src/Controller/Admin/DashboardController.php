<?php

namespace App\Controller\Admin;

use App\Entity\Bicycle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BicycleCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Atelier Vélo du Vernet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Vélo', 'fas fa-map-marker-alt', Bicycle::class);
        // yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
    }
}
