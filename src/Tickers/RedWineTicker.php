<?php

namespace App\Tickers;

use App\Klosterke;

class RedWineTicker implements Ticker
{
    public function tick(Klosterke $product): void
    {
        $product->kwaliteit++;
        $product->verkopenVoor--;

        if ($product->verkopenVoor < 0) {
            $product->kwaliteit++;
        }

        if ($product->kwaliteit > 50) {
            $product->kwaliteit = 50;
        }

    }

}
