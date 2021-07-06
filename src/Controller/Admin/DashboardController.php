<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return parent::index();
        } else {
            $this->addFlash('danger', 'User tried to access a page without having ROLE_ADMIN');
            return $this->redirectToRoute('app_login');
        }
    }

    public function configureDashboard(): Dashboard
    {
//        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return Dashboard::new()
            ->setTitle('CRUD Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to website', 'fa fa-home', 'home');
        yield MenuItem::linkToCrud('Article', "fas fa-newspaper", Article::class);
        yield MenuItem::linkToCrud('Users', "fas fa-users", User::class);
    }
}
