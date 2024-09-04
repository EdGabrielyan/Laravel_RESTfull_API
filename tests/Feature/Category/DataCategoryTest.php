<?php

namespace Tests\Feature\Category;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Category')]
class DataCategoryTest extends TestCase
{
    private string $url = 'api.category.data';

    public function test_success_get_data_category(): void
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

    public function test_fail_for_invalid_offset(): void
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
