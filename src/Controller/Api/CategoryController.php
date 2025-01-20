<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository) {}

    #[Route(
        path: '/api/category',
        name: 'index_category',
        methods: ['GET']
    )]
    public function index(): Response
    {
        try {
            $data = $this->categoryRepository->index();
            return $this->json([
                "category" => $data,
                "success" => true
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/category/{id}',
        name: 'show_category',
        methods: ['GET']
    )]
    public function show(int $id): Response
    {
        try {
            $data = $this->categoryRepository->show($id);
            return $this->json([
                "success" => true,
                "category" => $data
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/category',
        name: 'create_category',
        methods: ['POST']
    )]
    public function create(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $category = $this->categoryRepository->create($data);
            return $this->json([
                "msg" => "Категория добавлена",
                "success" => true,
                "category" => $category
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/category/{id}',
        name: 'update_category',
        methods: ['PUT']
    )]
    public function update(Request $request, int $id): Response
    {
        try {
            $data = $this->categoryRepository->update($request, $id);
            return $this->json([
                "msg" => "Категория изменена",
                "success" => true,
                "category" => $data
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/category/{id}',
        name: 'delete_category',
        methods: ['DELETE']
    )]
    public function delete(int $id)
    {
        try {
            $this->categoryRepository->delete($id);

            return $this->json([
                "msg" => "Категория удалена",
                "succes" => true
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/avg_price_category/{id}',
        name: 'avg_price_category',
        methods: ['GET']
    )]
    public function getAvgPriceCategory(int $id)
    {
        try {
            $avgPrice = $this->categoryRepository->getAvgPriceCategory($id);
            return $this->json([
                "avgPrice" => $avgPrice,
                "succes" => true
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }

    #[Route(
        path: '/api/avg_grade_category/{id}',
        name: 'avg_grade_category',
        methods: ['GET']
    )]
    public function getAvgGradeCategory(int $id)
    {
        try {
            $avgGrade = $this->categoryRepository->getAvgGradeCategory($id);
            return $this->json([
                "avgGrade" => $avgGrade,
                "succes" => true
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "success" => false,
                "code" => $e->getCode()
            ]);
        }
    }
}
