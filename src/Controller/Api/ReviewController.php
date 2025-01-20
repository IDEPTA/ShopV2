<?php

namespace App\Controller\Api;

use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    public function __construct(private ReviewRepository $reviewRepository) {}

    #[Route(
        path: '/api/review',
        name: 'index_review',
        methods: ['GET']
    )]
    public function index(): Response
    {
        try {
            $reviews = $this->reviewRepository->index();
            return $this->json([
                "reviews" => $reviews,
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
        path: '/api/review/{id}',
        name: 'show_review',
        methods: ['GET']
    )]
    public function show(int $id): Response
    {
        try {
            $reviews = $this->reviewRepository->show($id);
            return $this->json([
                "reviews" => $reviews,
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
        path: '/api/review',
        name: 'create_review',
        methods: ['POST']
    )]
    public function create(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $reviews = $this->reviewRepository->create($data);
            return $this->json([
                "reviews" => $reviews,
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
        path: '/api/review/{id}',
        name: 'update_review',
        methods: ['PUT']
    )]
    public function update(Request $request, int $id): Response
    {
        try {
            $reviews = $this->reviewRepository->update($request, $id);
            return $this->json([
                "reviews" => $reviews,
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
        path: '/api/review/{id}',
        name: 'delete_review',
        methods: ['DELETE']
    )]
    public function delete(int $id): Response
    {
        try {
            $this->reviewRepository->delete($id);
            return $this->json([
                "msg" => "Отзыв удален",
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
        path: '/api/review-for-user/{id}',
        name: 'review-for-user',
        methods: ['GET']
    )]
    public function getReviewForUser(int $id): Response
    {
        try {
            $reviews = $this->reviewRepository->getReviewForUser($id);
            return $this->json([
                "reviews" => $reviews,
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
