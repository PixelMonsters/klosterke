<?php

namespace App\Actions\Tickers;

use App\Models\Product;

interface Ticker
{
    public function tick(Product $product): void;
}
