<?php

namespace App\Tickers;

use App\Klosterke;

class MonasteryBeerTicker implements Ticker
{

    public function tick(Klosterke $product): void
    {
        $product->kwaliteit--;
        $product->kwaliteit--;
        $product->verkopenVoor--;

        if ($product->verkopenVoor < 0) {
            $product->kwaliteit--;
            $product->kwaliteit--;
        }

        if ($product->kwaliteit < 0) {
            $product->kwaliteit = 0;
        }

    }

}