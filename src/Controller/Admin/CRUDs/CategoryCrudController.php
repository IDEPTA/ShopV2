<?php

namespace App\Controller\Admin\CRUDs;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Назавание'),
            DateTimeField::new("created_at", 'Дата создания')->hideOnForm(),
            DateTimeField::new("updated_at", 'Дата обновления')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Категории')
            ->setPageTitle('new', 'Добавить категорию')
            ->setPageTitle('edit', 'Редактировать категорию')
            ->setEntityLabelInSingular('категорию')
            ->setEntityLabelInPlural('продукт')
            ->setDateTimeFormat("dd.mm.yyyy HH:mm:ss")
            ->setTimezone('Europe/Moscow')
            ->setPaginatorPageSize(5);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('name', 'Название');
    }
}
