<?php

namespace Bavyhappy\NovaCashierOverviewPlanDetail\Console;

use Bavyhappy\NovaCashierOverviewPlanDetail\Http\Models\Product;
use Illuminate\Console\Command;
use Laravel\Cashier\Cashier;

class SyncStripeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-stripe:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products stripe';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $existProducts = Product::pluck('stripe_id')->toArray();

        $products = Cashier::stripe()->products->all();
        foreach ($products as $product) {
            if (!in_array($product->id, $existProducts)) {
                Product::create([
                    'name' => $product->name,
                    'stripe_id' => $product->id,
                    'default_price' => $product->default_price,
                    'active' => $product->active,
                    'description' => $product->description,
                ]);
            }
        }

        dd('@completato');
    }
}
