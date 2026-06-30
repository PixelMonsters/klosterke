<?php

namespace App\Actions\Tickers;

use App\Models\Product;

class HistoricalTicker implements Ticker
{
    public function tick(Product $product): void
    {
        // Those items always stays the same
    }
}
