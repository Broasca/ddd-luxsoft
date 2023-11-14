<?php

namespace App\Controller\Admin;

use App\Entity\Auction;
use App\Entity\Bid;
use App\Entity\Company;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', []);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<i class="fas fa fa-home"></i> Admin ')
            ->disableUrlSignatures()
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('User Management');
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Companies', 'fa-solid fa-building', Company::class);

        yield MenuItem::section('Auction');
        yield MenuItem::linkToCrud('Auctions', 'fa-solid fa-hammer', Auction::class);
        yield MenuItem::linkToCrud('Items', 'fas fa-list', Item::class);
        yield MenuItem::linkToCrud('Bids', 'fas fa-list', Bid::class);

        yield MenuItem::section('Shipping');
        yield MenuItem::linkToCrud('Order', 'fa-solid fa-truck-fast', Order::class);

    }
}
