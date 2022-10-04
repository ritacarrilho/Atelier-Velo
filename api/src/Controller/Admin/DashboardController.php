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
use App\Repository\BicycleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriberRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var SubscriberRepository
     */
    private $subscriberRepo;

    /**
     * @var BicycleRepository
     */
    private $bicycleRepo;

    public function __construct(SubscriberRepository $subscriberRepository, BicycleRepository $bicycleRepository)
    {
        $this->subscriberRepo = $subscriberRepository;
        $this->bicycleRepo = $bicycleRepository;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') == true) {
            return $this->redirectToRoute('admin');
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $subscribers = $this->subscriberRepo->findAll();
        $bicycles = $this->bicycleRepo->findByDisponibility('0');

        return $this->render('admin/dashboard.html.twig', [
            'subscribers' => count($subscribers),
            'bicycles' => count($bicycles),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Atelier Vélo du Vernet');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoUrl('Accueil', 'fas fa-home', $this->generateUrl('app_home')),

            // MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Vélos et Produits'),
            MenuItem::linkToCrud('Vélo', 'fas fa-bicycle', Bicycle::class),
            MenuItem::linkToCrud('Vélo - taille', 'fas fa-bicycle', BicycleSize::class),
            MenuItem::linkToCrud('Vélo - modèle', 'fas fa-bicycle', BicycleType::class),
            MenuItem::linkToCrud('Produits', 'fas fa-store', Product::class),
            MenuItem::linkToCrud('Catégorie des produits', 'fas fa-store', ProductCategory::class),

            MenuItem::section('Evénements'),
            MenuItem::linkToCrud('Événements', 'fas fa-calendar-alt', Event::class),
            MenuItem::linkToCrud('Catégorie d\'événements', 'fas fa-calendar-alt', EventCategory::class),

            MenuItem::section('Adhérents et Utilisateurs'),
            MenuItem::linkToCrud('Adhérents', 'fas fa-biking', Subscriber::class),
            MenuItem::linkToCrud('Rôle d\'Adhérents', 'fas fa-user-friends', SubscriberRole::class)
                ->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Comptes', 'fas fa-user', User::class)
                ->setPermission('ROLE_ADMIN'),
        ];
    }
}
