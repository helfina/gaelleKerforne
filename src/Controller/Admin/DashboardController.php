<?php

namespace App\Controller\Admin;

use App\Entity\Caf;
use App\Entity\Mois;
use App\Entity\Prelevement;
use App\Entity\PretMaison;
use App\Entity\Revenues;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // on genere un url pour afficher la liste des utilisateur (genere la route correspondante a laffiche de la liste user )
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GaelleKerforne');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Gestion');
        yield MenuItem::subMenu('Users', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add User', 'fas fa-user-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users', 'fas fa-users', User::class)
        ]);
        yield MenuItem::section('Compta');
        yield MenuItem::subMenu('Mois', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Mois', 'fas fa-user-plus', Mois::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Mois', 'fas fa-users', Mois::class)
        ]);
        yield MenuItem::subMenu('Caf', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Caf', 'fas fa-user-plus', Caf::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Caf', 'fas fa-users', Caf::class)
        ]);
        yield MenuItem::subMenu('Revenues', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Revenue', 'fas fa-user-plus', Revenues::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Revenues', 'fas fa-users', Revenues::class)
        ]);
        yield MenuItem::subMenu('Prêts Maison', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Prêt Maison', 'fas fa-user-plus', PretMaison::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Prêts Maison', 'fas fa-users', PretMaison::class)
        ]);
        yield MenuItem::subMenu('Prelevements', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Prelevement', 'fas fa-user-plus', Prelevement::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Prelevement', 'fas fa-users', Prelevement::class)
        ]);
    }
}
