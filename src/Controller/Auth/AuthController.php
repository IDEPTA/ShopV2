<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class AuthController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private readonly JWTTokenManagerInterface $JWTmanager,
    ) {}

    #[Route('/api/auth/login', name: 'app_auth_login')]
    public function login(#[CurrentUser] ?User $user): Response
    {
        if (!$user) {
            return $this->json(['error' => 'Invalid credentials.'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $user,
            'token' => $this->JWTmanager->create($user),
        ]);
    }

    #[Route('/api/auth/register', name: 'app_auth_register')]
    public function registger(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $user = $this->userRepository->register($data);
            return $this->json([
                "msg" => "Пользователь зарегестрирован",
                "user" => $user,
                'token' => $this->JWTmanager->create($user),
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
