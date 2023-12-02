<?php

namespace Modules\User\Services\Interfaces;

use Illuminate\Http\JsonResponse;
use Modules\DummyApi\Exceptions\DummyApiException;
use Modules\User\DTO\ImportUserDTO;
use Modules\User\DTO\LoginDTO;
use Modules\User\Exceptions\LoginException;
use Modules\User\Exceptions\UserException;

interface UserServiceInterface
{
    /**
     * Login a user.
     *
     * @param LoginDTO $dto
     *
     * @return JsonResponse
     * @throws LoginException
     */
    public function login(LoginDTO $dto): JsonResponse;

    /**
     * Import a user from DummyApi.
     *
     * @param ImportUserDTO $dto
     *
     * @return JsonResponse
     * @throws UserException|DummyApiException
     */
    public function importUserFromDummyApi(ImportUserDTO $dto): JsonResponse;
}
