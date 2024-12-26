<?php

namespace App\Repository;

use Exception;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    private $validator;
    private $entityManager;
    public function __construct(ManagerRegistry $registry, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        parent::__construct($registry, Category::class);
    }


    public function index(): array
    {
        return $this->findAll();
    }

    public function show(int $id)
    {
        $category = $this->find($id);
        if (!$category) {
            throw new EntityNotFoundException("Категория с таким id не найдена!", 404);
        }
        return $category;
    }

    public function create(Request $request)
    {
        $category = new Category();
        $category->setName($request->get('name'));
        $errors = $this->validator->validate($category);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }

    public function update(Request $request, int $id)
    {
        $category = $this->show($id);
        $category->setName($request->toArray()['name']);
        $errors = $this->validator->validate($category);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->show($id);
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}
