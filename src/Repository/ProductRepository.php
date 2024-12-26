<?php

namespace App\Repository;

use Exception;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    private $validator;
    private $entityManager;
    public function __construct(ManagerRegistry $registry, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        parent::__construct($registry, Product::class);
    }

    public function index()
    {
        return $this->findAll();
    }

    public function show(int $id)
    {
        $product = $this->find($id);
        if (!$product) {
            throw new EntityNotFoundException("Продукт с таким id не найден", 404);
        }
        return $product;
    }

    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $category = $this->entityManager->getReference(Category::class, $data['category']);
        if (!$category) {
            throw new EntityNotFoundException("Категория с таким id не найдена", 404);
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setAvailability($data['availability']);
        $product->setQuantity($data['quantity']);
        $product->setPrice($data['price']);
        $product->setImages($data['images']);
        $product->setCategory($category);

        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product;
    }

    public function update(Request $request, int $id)
    {
        $product = $this->show($id);
        $data = json_decode($request->getContent(), true);

        $category = $this->entityManager->getReference(Category::class, $data['category']);

        if (!$category) {
            throw new EntityNotFoundException("Категория с таким id не найдена", 404);
        }

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setAvailability($data['availability']);
        $product->setQuantity($data['quantity']);
        $product->setPrice($data['price']);
        $product->setImages($data['images']);
        $product->setCategory($category);

        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new Exception($errorsString, 400);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product;
    }

    public function delete(int $id)
    {
        $product = $this->show($id);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}
