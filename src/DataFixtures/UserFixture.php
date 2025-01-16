<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'name' => 'Admin',
                'surname' => 'Admin',
                'patronymic' => 'Admin',
                'phone' => '1234567890',
                'email' => 'admin@admin.com',
                'password' => '123123123',
            ],
            [
                'name' => 'Сергей',
                'surname' => 'Прокопчук',
                'patronymic' => 'Александрович',
                'phone' => '85482314512',
                'email' => 's@yandex.ru',
                'password' => '123123123',
            ],
            [
                'name' => 'Виктор',
                'surname' => 'Малиев',
                'patronymic' => 'Александрович',
                'phone' => '89899889982',
                'email' => 'v@yandex.ru',
                'password' => '123123123',
            ],
            [
                'name' => 'Анна',
                'surname' => 'Иванова',
                'patronymic' => 'Сергеевна',
                'phone' => '89993415678',
                'email' => 'a@domain.com',
                'password' => '987654321',
            ],
            [
                'name' => 'Дмитрий',
                'surname' => 'Смирнов',
                'patronymic' => 'Николаевич',
                'phone' => '89012345678',
                'email' => 'd@domain.com',
                'password' => '111222333',
            ],
            [
                'name' => 'Елена',
                'surname' => 'Кузнецова',
                'patronymic' => 'Владимировна',
                'phone' => '89123456789',
                'email' => 'e@domain.com',
                'password' => 'qwerty123',
            ],
            [
                'name' => 'Петр',
                'surname' => 'Горбунов',
                'patronymic' => 'Игоревич',
                'phone' => '89998765432',
                'email' => 'p@domain.com',
                'password' => 'mypassword123',
            ],
            [
                'name' => 'Мария',
                'surname' => 'Лебедева',
                'patronymic' => 'Вячеславовна',
                'phone' => '89056784321',
                'email' => 'maria@domain.com',
                'password' => 'pass1234',
            ]
        ];

        foreach ($users as $value) {
            $this->userRepository->register($value);
        }
    }
}
