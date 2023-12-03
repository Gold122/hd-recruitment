<?php

namespace Http\Controllers\Api;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Modules\DummyApi\Client\Interfaces\DummyApiClientInterface;
use Modules\User\Enums\UserRoleEnum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public const PASSWORD = 'password';

    /** @test */
    public function it_can_login()
    {
        $user = UserFactory::new()->create(['password' => bcrypt(self::PASSWORD)]);

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => self::PASSWORD,
        ]);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'token'
            ]);
    }

    /** @test */
    public function it_cant_import()
    {
        $user = UserFactory::new()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson(route('users.import'), [
            'id' => 1,
            'password' => self::PASSWORD,
        ]);
        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJsonStructure([
                'message',
            ]);
    }

    /** @test */
    public function it_can_import()
    {
        $userData = [
            'id' => 'id_test',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'email_test@test.com',
        ];

        $this->mock(DummyApiClientInterface::class)->shouldReceive([
            'getUser' => $userData
        ])->once();

        $user = UserFactory::new()->create([
            'role' => UserRoleEnum::ADMIN
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson(route('users.import'), [
            'id' => 'id_test',
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'User imported successfully',
                'data' => [
                    'name' => $userData['firstName'] . ' ' . $userData['lastName'],
                    'email' => $userData['email'],
                ]
            ]);
    }
}
