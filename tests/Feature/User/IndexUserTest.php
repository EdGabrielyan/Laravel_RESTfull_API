<?php

namespace Tests\Feature\User;

use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[group('User')]
class IndexUserTest extends TestCase
{
    private string $url = 'api.user.index';

    public function test_success_user_index(): void
    {
        $offset = 0;
        $limit = 10;

        $response = $this->getJson(route($this->url, [
            'offset' => $offset,
            'limit' => $limit,
        ]));

        $response->assertOk();
    }

    public function test_fail_for_invalid_limit_and_offset(): void
    {

        $offset = -1;
        $limit = 11;

        $response = $this->getJson(route($this->url, [
            'offset' => $offset,
            'limit' => $limit,
        ]));

        $response->assertUnprocessable();
    }
}
