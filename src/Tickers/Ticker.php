<?php

namespace App\Tickers;

use App\Klosterke;

interface Ticker
{
    public function tick(Klosterke $product): void;

}
