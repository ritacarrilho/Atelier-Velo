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
use App\Repository\SubscriberRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
      /**
     * @var SubscriberRepository
     */
    private $subscriberRepo;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepo = $subscriberRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $subscribers = $this->subscriberRepo->findAll();


        return $this->render('admin/dashboard.html.twig', [
            'subscribers' => count($subscribers),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Atelier Vélo du Vernet');
    }

    // public function configureCrud(string $pageName): Crud
    // {
    //     $pageName = "Vélos";
    //     return Crud::new()->setPageTitle($pageName);
    // }
    
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Vélo', 'fas fa-bicycle', Bicycle::class);
        yield MenuItem::linkToCrud('Vélo taille', 'fas fa-bicycle', BicycleSize::class);
        yield MenuItem::linkToCrud('Vélo type', 'fas fa-bicycle', BicycleType::class);
        yield MenuItem::linkToCrud('Evénements', 'fas fa-calendar-alt', Event::class);
        yield MenuItem::linkToCrud('Catégorie des evénements', 'fas fa-calendar-alt', EventCategory::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-store', Product::class);
        yield MenuItem::linkToCrud('Catégorie des produits', 'fas fa-store', ProductCategory::class);
        yield MenuItem::linkToCrud('Adhérents', 'fas fa-biking', Subscriber::class);
        yield MenuItem::linkToCrud('Role des Adhérents', 'fas fa-user-friends', SubscriberRole::class);
        yield MenuItem::linkToCrud('Comptes', 'fas fa-user', User::class);
        yield MenuItem::linktoUrl('Accueil', 'fas fa-home', $this->generateUrl('app_home'));
    }
}
