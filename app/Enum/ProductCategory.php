<?php

namespace App\Enum;

use App\Actions\Tickers\HistoricalTicker;
use App\Actions\Tickers\MonasteryBeerTicker;
use App\Actions\Tickers\NormalTicker;
use App\Actions\Tickers\RedWineTicker;
use App\Actions\Tickers\Ticker;
use App\Actions\Tickers\WhiteWineTicker;

enum ProductCategory: string
{
    case NORMAL = 'normal';
    case RED_WINE = 'red-wine';
    case WHITE_WINE = 'white-wine';
    case HISTORICAL = 'historical';
    case MONASTERY_BEER = 'monastery-beer';

    public function label(): string
    {
        return match ($this) {
            self::NORMAL => 'Normaal',
            self::RED_WINE => 'Rode Wijn',
            self::WHITE_WINE => 'Witte Wijn',
            self::HISTORICAL => 'BBQ',
            self::MONASTERY_BEER => 'Kloosterbier',
        };
    }

    public function resolveTicker(): Ticker
    {
        return match ($this) {
            self::NORMAL => new NormalTicker,
            self::RED_WINE => new RedWineTicker,
            self::HISTORICAL => new HistoricalTicker,
            self::WHITE_WINE => new WhiteWineTicker,
            self::MONASTERY_BEER => new MonasteryBeerTicker,
        };
    }
}
