<?php

namespace App\Tickers;

use App\Klosterke;

class WhiteWineTicker implements Ticker
{
    public function tick(Klosterke $product): void
    {
        $product->kwaliteit++;
        $product->verkopenVoor--;

        if ($product->verkopenVoor < 10) {
            $product->kwaliteit++;
        }

        if ($product->verkopenVoor < 5) {
            $product->kwaliteit++;
        }

        if ($product->kwaliteit > 50) {
            $product->kwaliteit = 50;
        }

        if ($product->verkopenVoor < 0) {
            $product->kwaliteit = 0;
        }
    }

}
