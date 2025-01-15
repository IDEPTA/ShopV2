<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository) {}

    #[Route(
        path: '/api/products',
        name: 'index_products',
        methods: ['GET']
    )]
    public function index(): Response
    {
        try {
            $products = $this->productRepository->index();
            return $this->json([
                "products" => $products,
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
        path: '/api/products/{id}',
        name: 'show_product',
        methods: ['GET']
    )]
    public function show(int $id)
    {
        try {
            $product = $this->productRepository->show($id);
            return $this->json([
                "product" => $product,
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
        path: '/api/products',
        name: 'create_product',
        methods: ['POST']
    )]
    public function create(Request $request): Response
    {
        try {
            $product = $this->productRepository->create($request);
            return $this->json([
                "product" => $product,
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
        path: '/api/products/{id}',
        name: 'update_product',
        methods: ['PUT']
    )]
    public function update(Request $request, int $id): Response
    {
        try {
            $product = $this->productRepository->update($request, $id);
            return $this->json([
                "product" => $product,
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
        path: '/api/products/{id}',
        name: 'delete_product',
        methods: ['DELETE']
    )]
    public function delete(int $id): Response
    {
        try {
            $this->productRepository->delete($id);
            return $this->json([
                "msg" => "Продукт удален",
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
}
