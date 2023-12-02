<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportUserRequest;
use Illuminate\Http\JsonResponse;
use Modules\DummyApi\Exceptions\DummyApiException;
use Modules\User\DTO\ImportUserDTO;
use Modules\User\DTO\LoginDTO;
use Modules\User\Exceptions\LoginException;
use Modules\User\Exceptions\UserException;
use Modules\User\Services\Interfaces\UserServiceInterface;

class UserController extends Controller
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
     * @throws LoginException
     */
    public function login(LoginDTO $dto): JsonResponse
    {
        return $this->userService->login($dto);
    }

    /**
     * Import a user from DummyApi.
     *
     * @param ImportUserRequest $request
     *
     * @return JsonResponse
     * @throws DummyApiException
     * @throws UserException
     */
    public function import(ImportUserRequest $request): JsonResponse
    {
        return $this->userService->importUserFromDummyApi(
            ImportUserDTO::from($request->validated())
        );
    }
}
