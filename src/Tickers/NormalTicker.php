<?php

namespace App\Tickers;

use App\Klosterke;

class NormalTicker implements Ticker
{
    public function tick(Klosterke $product): void
    {
        $product->kwaliteit -= $this->getQualityModifier($product);
        $product->verkopenVoor--;

        if ($product->kwaliteit < 0) {
            $product->kwaliteit = 0;
        }

    }

    private function getQualityModifier(Klosterke $product): int
    {
        return $product->verkopenVoor > 0
            ? 1
            : 2;
    }

}
