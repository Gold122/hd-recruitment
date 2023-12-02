<?php

namespace Modules\User\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Modules\DummyApi\Services\Interfaces\UserServiceInterface as UserDummyApiServiceInterface;
use Modules\User\DTO\ImportUserDTO;
use Modules\User\DTO\LoginDTO;
use Modules\User\Exceptions\LoginException;
use Modules\User\Exceptions\UserException;
use Modules\User\Repositories\Contracts\UserRepositoryContract;
use Modules\User\Services\Interfaces\UserServiceInterface;

readonly class UserService implements UserServiceInterface
{
    /**
     * UserService constructor.
     *
     * @param UserRepositoryContract $userRepository
     * @param UserDummyApiServiceInterface $userDummyApiService
     */
    public function __construct(
        private UserRepositoryContract $userRepository,
        private UserDummyApiServiceInterface $userDummyApiService
    ) {}

    /**
     * @inheritDoc
     */
    public function login(LoginDTO $dto): JsonResponse
    {
        $user = $this->userRepository->findByEmail($dto->email);

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw LoginException::invalidCredentials();
        }

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

    /**
     * @inheritDoc
     */
    public function importUserFromDummyApi(ImportUserDTO $dto): JsonResponse
    {
        $userDummyApi = $this->userDummyApiService->getUser($dto->id);
        $user = $this->userRepository->findByEmail($userDummyApi->email);
        if ($user) {
            throw UserException::userAlreadyExists();
        }

        $this->userRepository->create([
            ...$userDummyApi->except('id')
                ->toArray(),
            'password' => bcrypt($dto->password),
        ]);

        return response()->json(['message' => 'User imported successfully', 'data' => $userDummyApi]);
    }
}
