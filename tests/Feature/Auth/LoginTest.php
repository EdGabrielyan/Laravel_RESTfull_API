<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("Auth")]
class LoginTest extends TestCase
{
    private string $url = 'api.login';

    public function test_success_login(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->url), [
           'email' => $user->email,
           'password' => 'password',
        ]);

        $response->assertOk();
    }

    public function test_fail_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->url), [
           'email' => $user->email,
           'password' => 'invalid_password',
        ]);

        $response->assertUnprocessable()
            ->assertInvalid('login');
    }
}
