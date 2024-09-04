<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Category')]
class IndexCategoryTest extends TestCase
{

    private string $url = 'api.category.index';

    public function test_success_index_category(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $offset = 0;
        $limit = 10;

        $response = $this->getJson(route($this->url, [
            'offset' => $offset,
            'limit' => $limit,
        ]));

        $response->assertOk();
    }

    public function test_fail_for_unauthorized_user(): void
    {
        $offset = 0;
        $limit = 10;

        $response = $this->getJson(route($this->url, [
            'offset' => $offset,
            'limit' => $limit,
        ]));

        $response->assertUnauthorized();
    }

    public function test_fail_for_invalid_limit_and_offset(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $offset = -1;
        $limit = 11;

        $response = $this->getJson(route($this->url, [
            'offset' => $offset,
            'limit' => $limit,
        ]));

        $response->assertUnprocessable();
    }
}
