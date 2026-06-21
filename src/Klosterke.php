<?php

namespace App;

use App\Enum\ProductCategory;

final class Klosterke
{
    public function __construct(
        public string $naam,
        public int $kwaliteit,
        public int $verkopenVoor,
        public ProductCategory $category,
    ) {

    }

    public static function of(string $naam, int $kwaliteit, int $verkopenVoor): self
    {

        $category = match ($naam) {
            'Rode Wijn - Merlot' => ProductCategory::RED_WINE,
            'Witte Wijn - Chardonnay' => ProductCategory::WHITE_WINE,
            'BBQ - Afkoop drank' => ProductCategory::HISTORICAL,
            'Kloosterbier - Franziskaner' => ProductCategory::MONASTERY_BEER,
            default => ProductCategory::NORMAL,
        };

        return new static($naam, $kwaliteit, $verkopenVoor, $category);
    }

    public function tick(): void
    {
        $ticker = $this->category->resolveTicker();
        $ticker->tick($this);
    }
}
