<?php

namespace App\Http\Services\Quotes;

use App\Contracts\QuoteService;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class YeService implements QuoteService
{
    /**
     * The endpoint for the quotes.
     *
     * @var string
     */
    private $endpoint = 'https://api.kanye.rest';

    /**
     * Number of times to retry on failure.
     *
     * @var int
     */
    private $retry = 3;

    /**
     * Time to wait before attempting a retry.
     *
     * @var int
     */
    private $backoff = 100;

    public function getQuotes(): Collection
    {
        $quotes = [];
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->retry($this->retry, $this->backoff)->get($this->endpoint),
            $pool->retry($this->retry, $this->backoff)->get($this->endpoint),
            $pool->retry($this->retry, $this->backoff)->get($this->endpoint),
            $pool->retry($this->retry, $this->backoff)->get($this->endpoint),
            $pool->retry($this->retry, $this->backoff)->get($this->endpoint),
        ]);

        foreach ($responses as $response) {
            $quotes[] = $response->json();
        }

        return collect($responses);
    }
}
