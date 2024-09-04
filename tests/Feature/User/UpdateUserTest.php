<?php

namespace Tests\Feature\User;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('User')]
class UpdateUserTest extends TestCase
{
    private string $url = 'api.user.update';

    public function test_success_user_update(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->putJson(route($this->url), [
            'name' => 'Test User',
            'password' => 'password',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
        ]);
    }

    public function test_fail_for_unauthorized_user(): void
    {
        $response = $this->putJson(route($this->url), [
            'name' => 'Test User',
            'password' => 'password',
        ]);

        $response->assertUnauthorized();

        $this->assertDatabaseMissing('users', [
           'name' => 'Test User',
        ]);
    }
}
