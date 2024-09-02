<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('Auth')]
class RegistrationTest extends TestCase
{
    use WithFaker;

    private string $url = 'api.user.registration';

    public function test_success_registration(): void
    {
        $email = $this->faker()->email();

        $response = $this->postJson(route($this->url), [
            'name' => 'name',
            'email' => $email,
            'password' => 'password'
        ]);

        $response->assertOk();

        $this->assertDatabaseHas(User::class, [
            'name' => 'name',
            'email' => $email,
        ]);
    }

    public function test_fail_registration_with_existing_email(): void
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
