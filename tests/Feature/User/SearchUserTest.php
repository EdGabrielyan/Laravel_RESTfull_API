<?php

namespace Tests\Feature\User;

use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('User')]
class SearchUserTest extends TestCase
{
    private string $url = 'api.user.search';

    public function test_success_search_user(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson(route($this->url,['name' => $user->name]));

        $response->assertOk();
    }

    public function test_fail_find_user(): void
    {
        User::factory()->create();

        $response = $this->getJson(route($this->url, ['name' => 'undefined_name']));

        $response->assertOk();
    }
}
