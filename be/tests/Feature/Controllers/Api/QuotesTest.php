<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Facades\QuoteFacade;

class QuotesTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private string $controllerEndpoint = '/api/ye-quotes';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $body = file_get_contents(base_path(
            'tests/Fixtures/Helpers/External/yeQuoteResponse.json'
        ));

        Sanctum::actingAs(
            $this->user,
            ['access-api']
        );

        Http::fake(['https://api.kanye.rest' => Http::response($body, 200)]);
    }

    public function test_endpoint_returns_quotes(): void
    {
        $response = $this->get($this->controllerEndpoint);

        $response->assertOk();
    }

    public function test_endpoint_returns_only_5_quotes(): void
    {
        $response = $this->get($this->controllerEndpoint);

        $response->assertJsonCount(5, 'data');
    }

    public function test_endpoint_return_structure(): void
    {
        $response = $this->get($this->controllerEndpoint);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'quote',
                ]
            ]
        ]);
    }

    public function test_endpoint_returns_forbidden_without_scope(): void
    {
        Sanctum::actingAs(
            $this->user,
            ['no-api']
        );
        $response = $this->get($this->controllerEndpoint);

        $response->assertForbidden();
    }

}
