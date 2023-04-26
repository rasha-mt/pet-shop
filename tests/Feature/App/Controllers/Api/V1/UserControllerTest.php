<?php

namespace App\Controllers\Api\V1;

use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_authenticated_user()
    {
        $user = UserFactory::new()->create([
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ]);

        $this->actingAs($user)
            ->getJson("api/v1/user")
            ->assertSuccessResponse()
            ->assertDataStructure([
                'uuid',
                'first_name',
                'last_name',
                'email',
                'email_verified_at',
                'avatar',
                'address',
                'phone_number',
                'is_marketing',
                'created_at',
                'updated_at',
                'last_login_at'
            ]);
    }

    public function test_user_cant_access_when_has_no_token()
    {
        UserFactory::new()->create([
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ]);
        $this->getJson("api/v1/user")
            ->assertUnauthorized();
    }

    public function test_admin_cant_access_user_data(){
        $user = UserFactory::new()->admin()->create([
            'email'    => 'rasha@test.com',
            'password' => '123456',
        ]);
        $this->assertTrue($user->is_admin);

        $this->actingAs($user)
            ->getJson("api/v1/user")
            ->assertUnauthorized();
    }
}
