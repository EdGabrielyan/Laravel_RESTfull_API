<?php

namespace Tests\Feature\User;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('User')]
class DestroyUserTest extends TestCase
{
    private string $url = 'api.user.destroy';

    public function test_success_destroy_user(): void
    {
        Sanctum::actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route($this->url));

        $response->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_fail_for_unauthorized_user(): void
    {
        $response = $this->deleteJson(route($this->url));

        $response->assertUnauthorized();
    }
}
