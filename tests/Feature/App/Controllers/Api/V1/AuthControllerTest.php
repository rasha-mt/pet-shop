<?php

namespace App\Controllers\Api\V1;

use Tests\TestCase;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_login()
    {
        UserFactory::new()->create([
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ]);

        $this->postJson("api/v1/user/login", [
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ])->assertSuccessful()
            ->assertSuccessResponse([
                'token'
            ]);
    }


    public function test_user_cannot_login_with_wrong_credential()
    {
        UserFactory::new()->create([
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ]);

        $this->postJson("api/v1/user/login", [
            'email'    => 'rasha@test.com',
            'password' => '1234',
        ])->assertFailedResponse('Failed to authenticate user', 422);
    }
}
