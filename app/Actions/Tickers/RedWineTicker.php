<?php

namespace App\Actions\Tickers;

use App\Models\Product;

class RedWineTicker implements Ticker
{
    public function tick(Product $product): void
    {
        $product->quality += $this->getQualityModifier($product);
        $product->sells_before--;

        if ($product->quality > 50) {
            $product->quality = 50;
        }

    }

    private function getQualityModifier(Product $product): int
    {
        return $product->sells_before > 0
            ? 1
            : 2;
    }
}
