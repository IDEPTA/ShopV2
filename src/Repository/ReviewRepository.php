<?php

namespace App\Repository;

use Exception;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    private $validator;
    private $entityManager;
    public function __construct(ManagerRegistry $registry, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        parent::__construct($registry, Review::class);
    }

    public function index()
    {
        return $this->findAll();
    }

    public function show(int $id)
    {
        $review = $this->find($id);
        if (!$review) {
            throw new EntityNotFoundException("Отзыв с таким id не найден", 404);
        }
        return $review;
    }

    public function create(array $data)
    {
        $product = $this->entityManager->getReference(Product::class, $data['product']);
        $user = $this->entityManager->getReference(User::class, $data['user']);

        if (!$product || !$user) {
            throw new EntityNotFoundException("Продукт или пользователь с таким id не найден", 404);
        }

        $review = new Review();
        $review->setGrade($data['grade']);
        $review->setComment($data['comment']);
        $review->setProduct($product);
        $review->setUser($user);

        $errors = $this->validator->validate($review);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($review);
        $this->entityManager->flush();
        return $review;
    }

    public function update(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);
        $review = $this->show($id);

        $product = $this->entityManager->getReference(Product::class, $data['product']);
        $user = $this->entityManager->getReference(User::class, $data['user']);

        if (!$product || !$user) {
            throw new EntityNotFoundException(
                "Продукт или пользователь с таким id не найден",
                404
            );
        }

        $review->setGrade($data['grade']);
        $review->setComment($data['comment']);
        $review->setProduct($product);
        $review->setUser($user);

        $errors = $this->validator->validate($review);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($review);
        $this->entityManager->flush();
        return $review;
    }

    public function delete(int $id)
    {
        $review = $this->show($id);
        $this->entityManager->remove($review);
        $this->entityManager->flush();
    }
}
