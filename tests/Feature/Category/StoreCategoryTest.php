<?php

namespace Tests\Feature\Category;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Category')]
class StoreCategoryTest extends TestCase
{
    private string $url = 'api.category.store';

    public function test_success_store_category(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route($this->url), [
            'name' => 'name',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('categories', [
            'name' => 'name'
        ]);
    }

    public function test_fail_for_unauthorized_user(): void
    {
        $response = $this->postJson(route($this->url), [
            'name' => 'name',
        ]);

        $response->assertUnauthorized();
    }
}
