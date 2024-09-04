<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Auth')]
class LogoutTest extends TestCase
{
    private string $url = 'api.logout';

    public function test_success_logout(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route($this->url));

        $response->assertOk();
    }

    public function test_fail_logout_for_unauthorized_user(): void
    {
        $response = $this->postJson(route($this->url));

        $response->assertUnauthorized();
    }
}
