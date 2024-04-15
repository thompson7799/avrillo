<?php

namespace App\Facades;

use App\Http\Managers\QuoteManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getQuotes()
 */
class QuoteFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return QuoteManager::class;
    }
}
