<?php

namespace App\Controller\Admin;

use App\Entity\Caf;
use App\Entity\Categories;
use App\Entity\Images;
use App\Entity\Mois;
use App\Entity\Portfolio;
use App\Entity\Prelevement;
use App\Entity\PretMaison;
use App\Entity\Quotidien;
use App\Entity\Revenues;
use App\Entity\Testimonials;
use App\Entity\User;
use App\Repository\CafRepository;
use App\Repository\MoisRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    private $mois;

    public function __construct(MoisRepository $moisRepository, CafRepository $cafRepository)
    {
        $mois = $moisRepository->findAll();
        $caf = $cafRepository->findAll();
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $mois = $this->mois;



        return $this->render('admin/index.html.twig',[
            'mois' => $mois,
        ]);
        // on genere un url pour afficher la liste des utilisateur (genere la route correspondante a laffiche de la liste user )
//        $url = $this->adminUrlGenerator
//            ->setController(UserCrudController::class)
//            ->generateUrl();
//        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GaelleKerforne');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Home Site', 'fas fa-home', 'app_home' );

        yield MenuItem::section('Front');
        yield MenuItem::subMenu('categories', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add User', 'fas fa-user-plus', Categories::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users', 'fas fa-users', Categories::class)
        ]);
        yield MenuItem::subMenu('Image', 'fas fa-i')->setSubItems([
            MenuItem::linkToCrud('Add image', 'fas fa-user-plus', Images::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show image', 'fas fa-users', Images::class)
        ]);
        yield MenuItem::subMenu('Portfolio', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add User', 'fas fa-user-plus', Portfolio::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users', 'fas fa-users', Portfolio::class)
        ]);
        yield MenuItem::subMenu('Testimonials', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Testimonials', 'fas fa-user-plus', Testimonials::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Testimonials', 'fas fa-users', Testimonials::class)
        ]);

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
        yield MenuItem::subMenu('Quotidien', 'fas fa-user-pilot')->setSubItems([
            MenuItem::linkToCrud('Add Quotidien', 'fas fa-user-plus', Quotidien::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Quotidien', 'fas fa-users', Quotidien::class)
        ]);
    }
}
