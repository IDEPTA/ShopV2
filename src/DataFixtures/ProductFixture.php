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
            ["category" => 1, "name" => "Макароны Barilla", "description" => "Итальянские макароны из твердых сортов пшеницы.", "availability" => true, "quantity" => 200, "price" => 199, "images" => []],
            ["category" => 1, "name" => "Шоколад Ritter Sport", "description" => "Шоколад Ritter Sport с молочной начинкой.", "availability" => true, "quantity" => 100, "price" => 159, "images" => []],
            ["category" => 2, "name" => "Корм для собак Pedigree", "description" => "Корм для собак с курицей и овощами.", "availability" => true, "quantity" => 50, "price" => 499, "images" => []],
            ["category" => 2, "name" => "Когтеточка для кошек", "description" => "Когтеточка для домашних кошек, высотой 50 см.", "availability" => true, "quantity" => 70, "price" => 699, "images" => []],
            ["category" => 3, "name" => "Смартфон Samsung Galaxy", "description" => "Смартфон с 64 ГБ памяти, экран 6.4 дюйма.", "availability" => true, "quantity" => 120, "price" => 24999, "images" => []],
            ["category" => 3, "name" => "Смартфон Xiaomi Redmi", "description" => "Смартфон с 128 ГБ памяти и камерой 48 МП.", "availability" => true, "quantity" => 150, "price" => 16999, "images" => []],
            ["category" => 4, "name" => "Пылесос Philips", "description" => "Безмешковый пылесос с мощностью всасывания 2000 Вт.", "availability" => true, "quantity" => 80, "price" => 4999, "images" => []],
            ["category" => 4, "name" => "Микроволновка Samsung", "description" => "Микроволновая печь с функцией гриля и мощностью 800 Вт.", "availability" => true, "quantity" => 60, "price" => 5999, "images" => []],
            ["category" => 5, "name" => "Моющее средство Ajax", "description" => "Средство для мытья посуды с лимонным запахом.", "availability" => true, "quantity" => 250, "price" => 99, "images" => []],
            ["category" => 5, "name" => "Стиральный порошок Ariel", "description" => "Порошок для стирки белого белья 2,5 кг.", "availability" => true, "quantity" => 180, "price" => 399, "images" => []],
            ["category" => 6, "name" => "Футболка H&M", "description" => "Футболка для мужчин из хлопка размер M.", "availability" => true, "quantity" => 120, "price" => 799, "images" => []],
            ["category" => 6, "name" => "Джинсы Levi's", "description" => "Джинсы классического кроя размер 32/32.", "availability" => true, "quantity" => 90, "price" => 4999, "images" => []],
            ["category" => 7, "name" => "Кроссовки Nike", "description" => "Мужские спортивные кроссовки для бега.", "availability" => true, "quantity" => 80, "price" => 3999, "images" => []],
            ["category" => 7, "name" => "Туфли женские", "description" => "Летние туфли для женщин с кожаным верхом.", "availability" => true, "quantity" => 100, "price" => 2999, "images" => []],
            ["category" => 8, "name" => "Плюшевый мишка", "description" => "Мягкая игрушка, высота 40 см.", "availability" => true, "quantity" => 200, "price" => 799, "images" => []],
            ["category" => 8, "name" => "Конструктор LEGO", "description" => "Конструктор LEGO для детей от 6 лет.", "availability" => true, "quantity" => 120, "price" => 1499, "images" => []],
            ["category" => 9, "name" => "Тени для век L'Oréal", "description" => "Тени для век с шиммером, цвет золотистый.", "availability" => true, "quantity" => 150, "price" => 899, "images" => []],
            ["category" => 9, "name" => "Тушь Maybelline", "description" => "Тушь для ресниц с эффектом объема.", "availability" => true, "quantity" => 200, "price" => 599, "images" => []],
            ["category" => 10, "name" => "Парфюм Chanel", "description" => "Парфюм Chanel No.5, 50 мл.", "availability" => true, "quantity" => 40, "price" => 5999, "images" => []],
            ["category" => 10, "name" => "Духи Gucci", "description" => "Парфюм Gucci Bloom, 100 мл.", "availability" => true, "quantity" => 60, "price" => 7999, "images" => []],
            ["category" => 11, "name" => "Подушка для дивана", "description" => "Декоративная подушка с вышивкой.", "availability" => true, "quantity" => 150, "price" => 599, "images" => []],
            ["category" => 11, "name" => "Коврик для ванной", "description" => "Коврик из микрофибры, 60х90 см.", "availability" => true, "quantity" => 120, "price" => 399, "images" => []],
            ["category" => 12, "name" => "Роликовые коньки", "description" => "Ролики с регулируемым размером для детей.", "availability" => true, "quantity" => 80, "price" => 2299, "images" => []],
            ["category" => 12, "name" => "Спортивная сумка Adidas", "description" => "Сумка для спорта с отделом для обуви.", "availability" => true, "quantity" => 150, "price" => 1999, "images" => []],
            ["category" => 13, "name" => "Сумка-клатч", "description" => "Кожаная сумка-клатч для вечерних выходов.", "availability" => true, "quantity" => 100, "price" => 1999, "images" => []],
            ["category" => 13, "name" => "Очки Ray-Ban", "description" => "Солнцезащитные очки с классической оправой.", "availability" => true, "quantity" => 120, "price" => 4999, "images" => []],
            ["category" => 14, "name" => "Автомобильный насос", "description" => "Компрессор для подкачки шин автомобиля.", "availability" => true, "quantity" => 90, "price" => 1499, "images" => []],
            ["category" => 14, "name" => "Магнитола Pioneer", "description" => "Магнитола с Bluetooth и AUX для автомобиля.", "availability" => true, "quantity" => 50, "price" => 7999, "images" => []],
            ["category" => 15, "name" => "Книга '1984' Джордж Оруэлл", "description" => "Роман о тоталитарном обществе, 320 страниц.", "availability" => true, "quantity" => 200, "price" => 499, "images" => []],
            ["category" => 15, "name" => "Книга 'Мастер и Маргарита' Михаил Булгаков", "description" => "Роман с элементами философской и мистической прозы.", "availability" => true, "quantity" => 150, "price" => 349, "images" => []],
            ["category" => 16, "name" => "Компьютерный стол", "description" => "Компьютерный стол с выдвижной полкой для клавиатуры.", "availability" => true, "quantity" => 100, "price" => 5999, "images" => []],
            ["category" => 16, "name" => "Кресло для офиса", "description" => "Офисное кресло с регулировкой высоты и подлокотниками.", "availability" => true, "quantity" => 80, "price" => 4999, "images" => []],
            ["category" => 17, "name" => "Блузка женская", "description" => "Блузка из шелка, размер S.", "availability" => true, "quantity" => 120, "price" => 1799, "images" => []],
            ["category" => 17, "name" => "Платье вечернее", "description" => "Вечернее платье для торжественных мероприятий, размер M.", "availability" => true, "quantity" => 60, "price" => 4999, "images" => []],
            ["category" => 18, "name" => "Золотое кольцо с бриллиантами", "description" => "Кольцо из 18 каратового золота с бриллиантами.", "availability" => true, "quantity" => 30, "price" => 39999, "images" => []],
            ["category" => 18, "name" => "Серьги с жемчугом", "description" => "Серьги из золота с натуральным жемчугом.", "availability" => true, "quantity" => 50, "price" => 19999, "images" => []],
            ["category" => 19, "name" => "Дрель Makita", "description" => "Электрическая дрель с функцией удара и регулировкой скорости.", "availability" => true, "quantity" => 100, "price" => 5999, "images" => []],
            ["category" => 19, "name" => "Лобзик Bosch", "description" => "Лобзик с регулятором скорости и системой антивибрации.", "availability" => true, "quantity" => 80, "price" => 3999, "images" => []],
            ["category" => 20, "name" => "Магнитный браслет", "description" => "Браслет с магнитами для улучшения кровообращения.", "availability" => true, "quantity" => 150, "price" => 499, "images" => []],
            ["category" => 20, "name" => "Витамины для взрослых", "description" => "Витамины для укрепления иммунитета и поддержания здоровья.", "availability" => true, "quantity" => 200, "price" => 799, "images" => []],
            ["category" => 21, "name" => "Карта для настольных игр", "description" => "Карта для настольной игры 'Монополия'.", "availability" => true, "quantity" => 80, "price" => 799, "images" => []],
            ["category" => 21, "name" => "Настольная игра 'Каркассон'", "description" => "Настольная игра для всей семьи.", "availability" => true, "quantity" => 60, "price" => 1699, "images" => []],
            ["category" => 22, "name" => "Гитара Fender", "description" => "Электрогитара Fender для начинающих.", "availability" => true, "quantity" => 40, "price" => 14999, "images" => []],
            ["category" => 22, "name" => "Синтезатор Yamaha", "description" => "Синтезатор с 61 клавишей и встроенными уроками.", "availability" => true, "quantity" => 50, "price" => 9999, "images" => []],
            ["category" => 23, "name" => "Растение кактус", "description" => "Кактус в горшке для декора.", "availability" => true, "quantity" => 150, "price" => 299, "images" => []],
            ["category" => 23, "name" => "Трава для аквариума", "description" => "Живая трава для аквариума, 2 саженца.", "availability" => true, "quantity" => 100, "price" => 199, "images" => []],
            ["category" => 24, "name" => "Паяльник", "description" => "Паяльник с комплектом насадок для работы с электроникой.", "availability" => true, "quantity" => 100, "price" => 1499, "images" => []],
            ["category" => 24, "name" => "Лампа светодиодная", "description" => "Светодиодная лампа с энергосбережением.", "availability" => true, "quantity" => 180, "price" => 199, "images" => []],
        ];

        foreach ($products as $value) {
            $this->productRepository->create($value);
        }
    }
}
