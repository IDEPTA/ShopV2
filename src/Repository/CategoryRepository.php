<?php

namespace App\Repository;

use Exception;
use App\Entity\Review;
use App\Entity\Category;
use App\Entity\Product;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Attribute\WithMonologChannel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Category>
 */
#[WithMonologChannel('category')]
class CategoryRepository extends ServiceEntityRepository
{
    private $validator;
    private $entityManager;
    private $logger;
    public function __construct(
        ManagerRegistry $registry,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
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

    public function create(array $data)
    {
        $category = new Category();
        $category->setName($data['name']);
        $errors = $this->validator->validate($category);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($category);
        $this->entityManager->flush();
        $this->logger->info("Создана новая категория", ["category" => $category]);
        return $category;
    }

    public function update(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);
        $category = $this->show($id);
        $category->setName($data['name']);
        $errors = $this->validator->validate($category);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($category);
        $this->entityManager->flush();
        $this->logger->info("Обновлена категория", ["category" => $category]);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->show($id);
        $this->entityManager->remove($category);
        $this->entityManager->flush();
        $this->logger->info("Категория удалена", ["category" => $category]);
    }

    public function getAvgPriceCategory(int $id)
    {
        $prices = $this->getEntityManager()
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p.price')
            ->where('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getScalarResult();
        $prices = array_map(fn($price) => $price['price'], $prices);
        $price = round(array_sum($prices) / count($prices), 2);

        return $price;
    }

    public function getAvgGradeCategory(int $id)
    {
        $grades = $this->getEntityManager()
            ->getRepository(Review::class)
            ->createQueryBuilder('r')
            ->innerJoin('r.product', 'p')
            ->select('r.grade')
            ->where('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getScalarResult();
        $grades = array_map(fn($grades) => $grades['grade'], $grades);
        $grade = round(array_sum($grades) / count($grades), 2);

        return $grade;
    }
}
