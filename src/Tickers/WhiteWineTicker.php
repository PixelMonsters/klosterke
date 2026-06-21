<?php

namespace App\Tickers;

use App\Klosterke;

class WhiteWineTicker implements Ticker
{
    public function tick(Klosterke $product): void
    {
        $product->kwaliteit += $this->getQualityModifier($product);
        $product->verkopenVoor--;

        if ($product->kwaliteit > 50) {
            $product->kwaliteit = 50;
        }

        if ($product->verkopenVoor < 0) {
            $product->kwaliteit = 0;
        }
    }

    private function getQualityModifier(Klosterke $product): int
    {
        return match (true) {
            $product->verkopenVoor <= 5 => 3,
            $product->verkopenVoor <= 10 => 2,
            default => 1,
        };
    }

}
