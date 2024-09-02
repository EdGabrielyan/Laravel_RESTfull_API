<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("Auth")]
class LoginTest extends TestCase
{
    private string $url = 'api.login';

    public function test_success(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->url), [
           'email' => $user->email,
           'password' => 'password',
        ]);

        $response->assertOk();
    }
}
