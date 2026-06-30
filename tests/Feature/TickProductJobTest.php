<?php

namespace Tests\Feature;

use App\Enum\ProductCategory;
use App\Jobs\TickProductJob;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TickProductJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_tick_processes_product(): void
    {
        $product = Product::factory()->create([
            'name' => 'normal',
            'quality' => 10,
            'sells_before' => 5,
            'category' => ProductCategory::NORMAL,
        ]);

        TickProductJob::dispatchSync($product);

        $product->refresh();

        $this->assertSame(9, $product->quality);
        $this->assertSame(4, $product->sells_before);
    }

    public function test_unique_id_returns_product_id(): void
    {
        $product = Product::factory()->create();

        $job = new TickProductJob($product);

        $this->assertSame((string) $product->id, $job->uniqueId());
    }
}
