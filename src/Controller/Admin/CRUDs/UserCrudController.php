<?php

namespace App\Controller\Admin\CRUDs;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name', 'Имя'),
            TextField::new('surname', 'Фамилия'),
            TextField::new('patronymic', 'Отчество'),
            EmailField::new('email', 'E-mail'),
            TextField::new('phone', 'Телефон'),
            DateTimeField::new('created_at', 'Дата регистрации')
                ->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Пользователи')
            ->setPageTitle('new', 'Добавить пользователя')
            ->setPageTitle('edit', 'Редактировать пользователя')
            ->setEntityLabelInSingular('пользователю')
            ->setEntityLabelInPlural('Пользователь')
            ->setDateTimeFormat("dd.mm.yyyy HH:mm:ss")
            ->setTimezone('Europe/Moscow')
            ->setPaginatorPageSize(5);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('name', 'Название')
            ->add('surname', 'Название')
            ->add('patronymic', 'Название')
            ->add('phone', 'Телефон')
            ->add('email', 'E-mail');
    }
}