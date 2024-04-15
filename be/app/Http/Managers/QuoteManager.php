<?php

namespace App\Http\Managers;

use App\Contracts\QuoteService;
use App\Http\Services\Quotes\YeService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Manager;

class QuoteManager extends Manager
{
    public function createYeDriver(): QuoteService
    {
        return App::make(YeService::class);
    }

    public function getDefaultDriver(): ?string
    {
        return 'Ye';
    }
}
