<?php

namespace Tests\Feature;

use App\Jobs\TickProductJob;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class TickAllProductsCommandTest extends TestCase
{
    use RefreshDatabase;
    public function test_dispatches_job_per_product(): void
    {
        Bus::fake();

        Product::factory()->count(3)->create();

        $this->artisan('app:tick-all-products')
            ->assertSuccessful()
            ->expectsOutput('Dispatched tick jobs for all products.');

        Bus::assertDispatchedTimes(TickProductJob::class, 3);
    }

    public function test_dispatches_nothing_when_no_products(): void
    {
        Bus::fake();

        $this->artisan('app:tick-all-products')
            ->assertSuccessful();

        Bus::assertDispatchedTimes(TickProductJob::class, 0);
    }
}
