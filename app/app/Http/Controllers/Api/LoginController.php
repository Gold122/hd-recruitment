<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\User\DTO\LoginDTO;
use Modules\User\Services\Interfaces\UserServiceInterface;

class LoginController extends Controller
{
    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(private readonly UserServiceInterface $userService) {}

    /**
     * Login a user.
     *
     * @param LoginDTO $dto
     *
     * @return JsonResponse
     */
    public function login(LoginDTO $dto): JsonResponse
    {
        $token = $this->userService->login($dto);

        return response()->json(['token' => $token]);
    }
}
