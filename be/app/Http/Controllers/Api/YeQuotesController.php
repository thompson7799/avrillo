<?php

namespace App\Http\Controllers\Api;

use App\Facades\QuoteFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YeQuotesController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->has('refresh')) {
                Cache::forget('user.'.auth()->user()->id.'.ye-quotes');
            }

            $quotes = Cache::remember('user.'.auth()->user()->id.'.ye-quotes', 60, function () {
                return QuoteFacade::driver('Ye')->getQuotes();
            });

            return QuoteResource::collection($quotes);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json('Server Error - Please contact support.', 501);
        }
    }
}
