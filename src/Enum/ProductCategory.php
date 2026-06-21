<?php

namespace App\Enum;

use App\Tickers\HistoricalTicker;
use App\Tickers\MonasteryBeerTicker;
use App\Tickers\NormalTicker;
use App\Tickers\RedWineTicker;
use App\Tickers\Ticker;
use App\Tickers\WhiteWineTicker;

enum ProductCategory: string
{
    case NORMAL = 'normal';
    case RED_WINE = 'red-wine';
    case WHITE_WINE = 'white-wine';
    case HISTORICAL = 'historical';
    case MONASTERY_BEER = 'monastery-beer';

    public function resolveTicker(): Ticker
    {
        return match ($this) {
            self::NORMAL => new NormalTicker(),
            self::RED_WINE => new RedWineTicker(),
            self::HISTORICAL => new HistoricalTicker(),
            self::WHITE_WINE => new WhiteWineTicker(),
            self::MONASTERY_BEER => new MonasteryBeerTicker(),
        };
    }

}
