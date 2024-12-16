<?php

namespace App\Controller\Admin\CRUDs;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            NumberField::new('grade', 'Оценка'),
            TextareaField::new('comment', 'Комментарий'),
            AssociationField::new('user', 'Пользователь')
                ->formatValue(function ($value) {
                    return $value ? $value->getFullName() : 'Не указано';
                }),
            AssociationField::new('product', 'Продукт')
                ->formatValue(function ($value) {
                    return $value ? $value->getName() : 'Не указано';
                }),
            DateTimeField::new("created_at", 'Дата создания')
                ->hideOnForm()
                ->setRequired(false),
            DateTimeField::new("updated_at", 'Дата обновления')
                ->hideOnForm()
                ->setRequired(false),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Отзывы')
            ->setPageTitle('new', 'Добавить отзыв')
            ->setPageTitle('edit', 'Редактировать отзыв')
            ->setEntityLabelInSingular('отзыв')
            ->setEntityLabelInPlural('Отзыв')
            ->setDateTimeFormat("dd.mm.yyyy HH:mm:ss")
            ->setTimezone('Europe/Moscow')
            ->setPaginatorPageSize(5);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('user', 'Пользователь')
            ->add('product', 'Продукт')
            ->add('grade', 'Оценка')
            ->add('comment', 'Комментарий');
    }
}