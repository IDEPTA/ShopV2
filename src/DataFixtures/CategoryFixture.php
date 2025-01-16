<?php

namespace App\DataFixtures;

use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        $categories = [
            ["name" => "Еда"],
            ["name" => "Товары для животных"],
            ["name" => "Смартфоны"],
            ["name" => "Бытовая техника"],
            ["name" => "Бытовая химия"],
            ["name" => "Одежда"],
            ["name" => "Обувь"],
            ["name" => "Игрушки"],
            ["name" => "Косметика"],
            ["name" => "Парфюмерия"],
            ["name" => "Товары для дома"],
            ["name" => "Спортивные товары"],
            ["name" => "Аксессуары"],
            ["name" => "Автотовары"],
            ["name" => "Книги"],
            ["name" => "Мебель"],
            ["name" => "Часы"],
            ["name" => "Техника для кухни"],
            ["name" => "Компьютеры"],
            ["name" => "Гаджеты"],
            ["name" => "Оборудование для офиса"],
            ["name" => "Мода"],
            ["name" => "Ювелирные изделия"],
            ["name" => "Инструменты"],
            ["name" => "Продукты для здоровья"],
            ["name" => "Игры и развлечения"],
            ["name" => "Музыка"],
            ["name" => "Флора и фауна"],
            ["name" => "Товары для детей"],
            ["name" => "Хобби и творчество"],
            ["name" => "Строительные материалы"],
            ["name" => "Электротовары"]
        ];

        foreach ($categories as $value) {
            $this->categoryRepository->create($value);
        }
    }

    // public function getDependencies(): array
    // {
    //     return [
    //         UserFixture::class,
    //     ];
    // }
}
