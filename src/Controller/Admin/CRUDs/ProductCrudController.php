<?php

namespace App\Controller\Admin\CRUDs;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Название'),
            TextareaField::new('description', 'Описание'),
            MoneyField::new('price', 'Цена,р')->setCurrency('RUB'),
            NumberField::new('quantity', 'Количество,шт'),
            BooleanField::new('availability', 'Доступность'),
            CollectionField::new('images', 'Количество изображений')
                ->setEntryType(FileUploadType::class) // Указываем тип поля FileField для загрузки изображений
                ->setFormTypeOptions([
                    'allow_add' => true, // Разрешаем добавление новых файлов
                    'allow_delete' => true, // Разрешаем удаление файлов
                    'entry_type' => ImageField::class, // Указываем, что каждый элемент коллекции — это загрузка файла
                    'by_reference' => false, // Отключаем ссылочную передачу
                ])
                ->setHelp('Загрузите несколько изображений для товара'),
            ImageField::new('images', 'Изображения')  // Используем ImageField для отображения изображений
                ->setBasePath('uploads/files') // Путь, где хранятся изображения
                ->setUploadDir('public/uploads/files')
                ->onlyOnIndex(),
            AssociationField::new('category', 'Категория')
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
            ->setPageTitle('index', 'Продукция')
            ->setPageTitle('new', 'Добавить товар')
            ->setPageTitle('edit', 'Редактировать товар')
            ->setEntityLabelInSingular('продукт')
            ->setEntityLabelInPlural('продукт')
            ->setDateTimeFormat("dd.mm.yyyy HH:mm:ss")
            ->setTimezone('Europe/Moscow')
            ->setPaginatorPageSize(5);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('name', 'Название')
            ->add('description', 'Описание')
            ->add('price', 'Цена')
            ->add('quantity', 'Количество')
            ->add('availability', 'Доступность')
            ->add('category', 'Категория');
    }
}