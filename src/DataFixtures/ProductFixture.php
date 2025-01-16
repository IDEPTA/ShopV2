<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Psr\Log\LoggerInterface;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixture extends Fixture
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly LoggerInterface $logger
    ) {}

    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                "category" => 1,
                "name" => "Паста из гречневой муки",
                "description" => "Здоровая паста из гречневой муки, без глютена, 500г.",
                "availability" => true,
                "quantity" => 150,
                "price" => 230,
                "images" => [],
            ],
            [
                "category" => 2,
                "name" => "Игрушка для кошек 'Мышь'",
                "description" => "Мягкая игрушка в виде мыши для кошек, размер S.",
                "availability" => true,
                "quantity" => 300,
                "price" => 50,
                "images" => [],
            ],
            [
                "category" => 3,
                "name" => "Samsung Galaxy S22",
                "description" => "Флагманский смартфон Samsung Galaxy S22, 128GB, в комплекте зарядка.",
                "availability" => true,
                "quantity" => 25,
                "price" => 74999,
                "images" => [],
            ],
            [
                "category" => 4,
                "name" => "Миксер BOSCH",
                "description" => "Миксер BOSCH с 5 насадками, мощность 500Вт.",
                "availability" => true,
                "quantity" => 50,
                "price" => 1799,
                "images" => [],
            ],
            [
                "category" => 5,
                "name" => "Средство для уборки туалета 'Доместос'",
                "description" => "Средство для уборки туалета Доместос 750 мл, эффективно удаляет запахи.",
                "availability" => true,
                "quantity" => 600,
                "price" => 120,
                "images" => [],
            ],
            [
                "category" => 6,
                "name" => "Рубашка мужская",
                "description" => "Рубашка мужская синего цвета, размер L, 100% хлопок.",
                "availability" => true,
                "quantity" => 200,
                "price" => 799,
                "images" => [],
            ],
            [
                "category" => 7,
                "name" => "Обувь кроссовки Nike",
                "description" => "Кроссовки Nike, размер 42, для активного отдыха.",
                "availability" => true,
                "quantity" => 100,
                "price" => 3999,
                "images" => [],
            ],
            [
                "category" => 8,
                "name" => "Конструктор Lego",
                "description" => "Конструктор Lego, набор 250 деталей, для детей от 6 лет.",
                "availability" => true,
                "quantity" => 150,
                "price" => 1499,
                "images" => [],
            ],
            [
                "category" => 9,
                "name" => "Тональный крем L'Oréal",
                "description" => "Тональный крем L'Oréal, тон 23, 30 мл.",
                "availability" => true,
                "quantity" => 300,
                "price" => 899,
                "images" => [],
            ],
            [
                "category" => 10,
                "name" => "Парфюм Chanel No.5",
                "description" => "Женский парфюм Chanel No.5, 50 мл.",
                "availability" => true,
                "quantity" => 50,
                "price" => 8000,
                "images" => [],
            ],
            [
                "category" => 11,
                "name" => "Набор посуды из нержавеющей стали",
                "description" => "Набор кастрюль и сковородок из нержавеющей стали, 7 предметов.",
                "availability" => true,
                "quantity" => 30,
                "price" => 3999,
                "images" => [],
            ],
            [
                "category" => 12,
                "name" => "Бутылка для воды Contigo",
                "description" => "Бутылка для воды с термоизоляцией, 750 мл.",
                "availability" => true,
                "quantity" => 250,
                "price" => 999,
                "images" => [],
            ],
            [
                "category" => 13,
                "name" => "Спортивный инвентарь: гантели",
                "description" => "Гантели с весом 2 кг, комплект из двух штук.",
                "availability" => true,
                "quantity" => 150,
                "price" => 550,
                "images" => [],
            ],
            [
                "category" => 14,
                "name" => "Чехол для смартфона",
                "description" => "Прочный чехол для iPhone 12, защитный, с силиконовым покрытием.",
                "availability" => true,
                "quantity" => 200,
                "price" => 499,
                "images" => [],
            ],
            [
                "category" => 15,
                "name" => "Автомобильный аккумулятор Varta",
                "description" => "Аккумулятор для автомобилей Varta, 12V, 60Ah.",
                "availability" => true,
                "quantity" => 100,
                "price" => 6999,
                "images" => [],
            ],
            [
                "category" => 16,
                "name" => "Роман 'Мастера и Маргарита'",
                "description" => "Роман Михаила Булгакова 'Мастер и Маргарита', издание 2021 года.",
                "availability" => true,
                "quantity" => 200,
                "price" => 350,
                "images" => [],
            ],
            [
                "category" => 17,
                "name" => "Комплект постельного белья",
                "description" => "Комплект постельного белья из 100% хлопка, для кровати размером 160x200 см.",
                "availability" => true,
                "quantity" => 100,
                "price" => 1499,
                "images" => [],
            ],
            [
                "category" => 18,
                "name" => "Кожаный ремень",
                "description" => "Ремень из натуральной кожи, цвет черный, размер 95 см.",
                "availability" => true,
                "quantity" => 250,
                "price" => 1199,
                "images" => [],
            ],
            [
                "category" => 19,
                "name" => "Сковорода Tefal",
                "description" => "Сковорода Tefal с антипригарным покрытием, диаметр 24 см.",
                "availability" => true,
                "quantity" => 80,
                "price" => 1899,
                "images" => [],
            ],
            [
                "category" => 20,
                "name" => "Планшет Samsung Galaxy Tab S8",
                "description" => "Планшет Samsung Galaxy Tab S8 с экраном 12.4 дюйма, 128GB.",
                "availability" => true,
                "quantity" => 40,
                "price" => 59999,
                "images" => [],
            ],
            [
                "category" => 21,
                "name" => "Карты памяти SanDisk",
                "description" => "Карта памяти microSD SanDisk 64GB, класс 10.",
                "availability" => true,
                "quantity" => 500,
                "price" => 499,
                "images" => [],
            ],
            [
                "category" => 22,
                "name" => "Кофемашина DeLonghi",
                "description" => "Кофемашина DeLonghi для приготовления эспрессо, модель ECAM350.55.",
                "availability" => true,
                "quantity" => 20,
                "price" => 24999,
                "images" => [],
            ],
            [
                "category" => 23,
                "name" => "Ювелирное кольцо",
                "description" => "Кольцо с сапфиром 18K золото, размер 16.",
                "availability" => true,
                "quantity" => 10,
                "price" => 29999,
                "images" => [],
            ],
            [
                "category" => 24,
                "name" => "Электрический инструмент Bosch",
                "description" => "Электрический дрель Bosch с 2 аккумуляторами и зарядным устройством.",
                "availability" => true,
                "quantity" => 150,
                "price" => 2999,
                "images" => [],
            ],
            [
                "category" => 25,
                "name" => "Витамины для иммунитета",
                "description" => "Витамины для укрепления иммунной системы, 30 капсул.",
                "availability" => true,
                "quantity" => 500,
                "price" => 599,
                "images" => [],
            ],
            [
                "category" => 26,
                "name" => "Игры для PlayStation 5",
                "description" => "Игры для PlayStation 5, комплект из 3-х популярных игр.",
                "availability" => true,
                "quantity" => 100,
                "price" => 2999,
                "images" => [],
            ],
            [
                "category" => 27,
                "name" => "Наушники Sony",
                "description" => "Наушники Sony WH-1000XM4 с шумоподавлением.",
                "availability" => true,
                "quantity" => 50,
                "price" => 12999,
                "images" => [],
            ]
        ];

        foreach ($products as $value) {
            $this->productRepository->create($value);
        }
    }
}
