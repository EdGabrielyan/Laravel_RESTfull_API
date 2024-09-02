<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Auth')]
class RegistrationTest extends TestCase
{
    private string $url = 'api.user.registration';

    public function test_success_registration(): void
    {
        $response = $this->postJson(route($this->url), [
            'name' => 'name',
            'email' => 'testEmailExample@gmail.com',
            'password' => 'password'
        ]);

        $response->assertOk();

        $this->assertDatabaseHas(User::class, [
            'name' => 'name',
            'email' => 'testEmailExample@gmail.com',
        ]);
    }

    public function test_fail_registration_by_existing_email(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->url), [
            'name' => 'name',
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertUnprocessable()
            ->assertInvalid('email');
    }
}
