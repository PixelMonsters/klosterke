<?php

namespace App\Actions\Tickers;

use App\Models\Product;

class WhiteWineTicker implements Ticker
{
    public function tick(Product $product): void
    {
        $product->quality += $this->getQualityModifier($product);
        $product->sells_before--;

        if ($product->quality > 50) {
            $product->quality = 50;
        }

        if ($product->sells_before < 0) {
            $product->quality = 0;
        }
    }

    private function getQualityModifier(Product $product): int
    {
        return match (true) {
            $product->sells_before <= 5 => 3,
            $product->sells_before <= 10 => 2,
            default => 1,
        };
    }
}
