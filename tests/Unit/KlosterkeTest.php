<?php

namespace Tests\Unit;

use App\Enum\ProductCategory;
use App\Models\Product;
use Tests\TestCase;

class KlosterkeTest extends TestCase
{
    public function test_update_normal_items_voor_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'normal',
            'category' => ProductCategory::NORMAL,
            'quality' => 10,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(9, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_update_normal_items_op_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'normal',
            'category' => ProductCategory::NORMAL,
            'quality' => 10,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(8, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_normal_items_na_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'normal',
            'category' => ProductCategory::NORMAL,
            'quality' => 10,
            'sells_before' => -5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(8, $product->quality);
        $this->assertSame(-6, $product->sells_before);
    }

    public function test_update_normal_items_with_a_quality_of_0(): void
    {
        $product = Product::factory()->make([
            'name' => 'normal',
            'category' => ProductCategory::NORMAL,
            'quality' => 0,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    // Rode Wijn Items

    public function test_update_rode_wijn_items_voor_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 10,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(11, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_update_rode_wijn_items_voor_de_verkoopdatum_with_maximum_quality(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 50,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_update_rode_wijn_items_op_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 10,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(12, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_rode_wijn_items_op_de_verkoopdatum_nabij_de_maximale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 49,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_rode_wijn_items_op_de_verkoopdatum_met_de_maximale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 50,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_rode_wijn_items_na_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 10,
            'sells_before' => -10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(12, $product->quality);
        $this->assertSame(-11, $product->sells_before);
    }

    public function test_update_rode_wijn_items_na_de_verkoopdatum_met_de_maximale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Rode Wijn - Merlot',
            'category' => ProductCategory::RED_WINE,
            'quality' => 50,
            'sells_before' => -10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(-11, $product->sells_before);
    }

    // BBQ Items

    public function test_update_bbq_items_voor_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'BBQ - Afkoop drank',
            'category' => ProductCategory::HISTORICAL,
            'quality' => 10,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(10, $product->quality);
        $this->assertSame(5, $product->sells_before);
    }

    public function test_update_bbq_items_op_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'BBQ - Afkoop drank',
            'category' => ProductCategory::HISTORICAL,
            'quality' => 10,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(10, $product->quality);
        $this->assertSame(5, $product->sells_before);
    }

    public function test_update_bbq_items_na_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'BBQ - Afkoop drank',
            'category' => ProductCategory::HISTORICAL,
            'quality' => 10,
            'sells_before' => -1,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(10, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    // Witte Wijn Items

    public function test_update_witte_wijn_items_lang_voor_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => 11,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(11, $product->quality);
        $this->assertSame(10, $product->sells_before);
    }

    public function test_update_witte_wijn_items_dicht_bij_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => 10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(12, $product->quality);
        $this->assertSame(9, $product->sells_before);
    }

    public function test_update_witte_wijn_items_dicht_bij_de_verkoopdatum_op_de_maximale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 50,
            'sells_before' => 10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(9, $product->sells_before);
    }

    public function test_update_witte_wijn_items_dicht_bij_de_verkoopdatum_met_5_dagen(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(13, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_update_witte_wijn_items_dicht_bij_de_verkoopdatum_op_de_maximale_kwaliteit_met_5_dagen(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 50,
            'sells_before' => 5,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_update_witte_wijn_items_met_slechts_1_dag_te_gaan(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => 1,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(13, $product->quality);
        $this->assertSame(0, $product->sells_before);
    }

    public function test_update_witte_wijn_items_met_slechts_1_dag_te_gaan_op_de_maximale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 50,
            'sells_before' => 1,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(50, $product->quality);
        $this->assertSame(0, $product->sells_before);
    }

    public function test_update_witte_wijn_items_op_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_witte_wijn_items_na_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Witte Wijn - Chardonnay',
            'category' => ProductCategory::WHITE_WINE,
            'quality' => 10,
            'sells_before' => -1,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(-2, $product->sells_before);
    }

    // Kloosterbier Items

    public function test_update_kloosterbier_items_voor_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 10,
            'sells_before' => 10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(8, $product->quality);
        $this->assertSame(9, $product->sells_before);
    }

    public function test_update_kloosterbier_items_op_de_minimale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 0,
            'sells_before' => 10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(9, $product->sells_before);
    }

    public function test_update_kloosterbier_items_op_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 10,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(6, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_kloosterbier_items_op_de_verkoopdatum_op_de_minimale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 0,
            'sells_before' => 0,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(-1, $product->sells_before);
    }

    public function test_update_kloosterbier_items_na_de_verkoopdatum(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 10,
            'sells_before' => -10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(6, $product->quality);
        $this->assertSame(-11, $product->sells_before);
    }

    public function test_update_kloosterbier_items_na_de_verkoopdatum_op_de_minimale_kwaliteit(): void
    {
        $product = Product::factory()->make([
            'name' => 'Kloosterbier - Franziskaner',
            'category' => ProductCategory::MONASTERY_BEER,
            'quality' => 0,
            'sells_before' => -10,
        ]);

        $product->category->resolveTicker()->tick($product);

        $this->assertSame(0, $product->quality);
        $this->assertSame(-11, $product->sells_before);
    }
}
