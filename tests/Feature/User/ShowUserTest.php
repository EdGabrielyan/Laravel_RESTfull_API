<?php

namespace Tests\Feature\User;

use App\Models\Product;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('User')]
class ShowUserTest extends TestCase
{
    private string $url = 'api.user.show';

    public function test_success_show_user(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $product->user_id = $user->id;

        $response = $this->getJson(route($this->url, ['user' => $user->id]));

        $response->assertOk();
    }

    public function test_fail_undefined_id_show_user(): void
    {
        $undefined_id = 999;

        $response= $this->getJson(route($this->url, ['user' => $undefined_id]));

        $response->assertNotFound();
    }
}
