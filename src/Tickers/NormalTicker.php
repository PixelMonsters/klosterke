<?php

namespace App\Tickers;

use App\Klosterke;

class NormalTicker implements Ticker
{

    public function tick(Klosterke $product): void
    {
        $product->kwaliteit--;
        $product->verkopenVoor--;

        if ($product->verkopenVoor < 0) {
            $product->kwaliteit--;
        }

        if ($product->kwaliteit < 0) {
            $product->kwaliteit = 0;
        }

    }

}