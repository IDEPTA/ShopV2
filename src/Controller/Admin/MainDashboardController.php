<?php

namespace App\Controller\Admin;

use App\Controller\Admin\CRUDs\ProductCrudController;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class MainDashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Продукты')
            ->setDefaultColorScheme('light')
            ->renderSidebarMinimized()
            ->generateRelativeUrls()
            ->setLocales([
                'en' => '🇬🇧 English',
                'ru' => 'ru Russian'
            ])
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Управление продуктами');
        yield MenuItem::linkToCrud('Пользователи', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Отзывы', 'fa fa-comment', Review::class);
        yield MenuItem::linkToCrud('Продукты', 'fa fa-box', Product::class);
        yield MenuItem::linkToCrud('Категория', 'fa fa-list', Category::class);
    }
}