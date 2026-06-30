<?php

namespace App\Console\Commands;

use App\Jobs\TickProductJob;
use App\Models\Product;
use Illuminate\Console\Command;

class TickAllProducts extends Command
{
    protected $signature = 'app:tick-all-products';

    protected $description = 'Dispatch a tick job for every product';

    public function handle(): void
    {
        Product::chunk(100, function ($products) {
            foreach ($products as $product) {
                TickProductJob::dispatch($product);
            }
        });

        $this->info('Dispatched tick jobs for all products.');
    }
}
