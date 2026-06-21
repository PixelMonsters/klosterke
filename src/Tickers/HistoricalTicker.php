<?php

namespace App\Tickers;

use App\Klosterke;

class HistoricalTicker implements Ticker
{
    public function tick(Klosterke $product): void
    {
        //Those items always stays the same
    }

}
