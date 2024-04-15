<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface QuoteService
{
    public function getQuotes(): Collection;
}
