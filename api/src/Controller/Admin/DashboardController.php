<?php

namespace App\Controller\Admin;

use App\Entity\Bicycle;
use App\Entity\BicycleSize;
use App\Entity\BicycleType;
use App\Entity\Event;
use App\Entity\EventCategory;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\Subscriber;
use App\Entity\SubscriberRole;
use App\Entity\User;
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
        //TODO: dashboard homepage

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BicycleCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(BicycleSizeCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(BicycleTypeCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(EventCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(EventCategoryCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ProductCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ProductCategoryCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(SubscriberCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(SubscriberRoleCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();


        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Atelier Vélo du Vernet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Vélo', 'fas fa-bicycle', Bicycle::class);
        yield MenuItem::linkToCrud('Vélo taille', 'fas fa-bicycle', BicycleSize::class);
        yield MenuItem::linkToCrud('Vélo type', 'fas fa-bicycle', BicycleType::class);
        yield MenuItem::linkToCrud('Evénements', 'fas fa-calendar-alt', Event::class);
        yield MenuItem::linkToCrud('Categorie des evénements', 'fas fa-calendar-alt', EventCategory::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-store', Product::class);
        yield MenuItem::linkToCrud('Categorie des produits', 'fas fa-store', ProductCategory::class);
        yield MenuItem::linkToCrud('Adhérents', 'fas fa-biking', Subscriber::class);
        yield MenuItem::linkToCrud('Role des Adhérents', 'fas fa-user-friends', SubscriberRole::class);
        yield MenuItem::linkToCrud('Comptes', 'fas fa-user', User::class);
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
    }
}
