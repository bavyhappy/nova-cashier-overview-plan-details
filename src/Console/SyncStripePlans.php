<?php

namespace Bavyhappy\NovaCashierOverviewPlanDetail\Console;

use Bavyhappy\NovaCashierOverviewPlanDetail\Http\Models\Plan;
use Bavyhappy\NovaCashierOverviewPlanDetail\Http\Models\Product;
use Illuminate\Console\Command;
use Laravel\Cashier\Cashier;

class SyncStripePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-stripe:plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync plans stripe';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::pluck('id', 'stripe_id')->toArray();
        $existPlans = Plan::pluck('stripe_id')->toArray();

        $plans = Cashier::stripe()->plans->all();
        foreach ($plans as $plan) {
            if (!in_array($plan->id, $existPlans) && array_key_exists($plan->product, $products)) {
                $int = substr($plan->amount_decimal, 0, -2);
                $deciman = substr($plan->amount_decimal, -2);
                Plan::create([
                    'product_id' => $products[$plan->product],
                    'stripe_id' => $plan->id,
                    'active' => $plan->active,
                    'currency' => $plan->currency,
                    'interval' => $plan->interval ?? NULL,
                    'amount' => floatval($int . '.' . $deciman)
                ]);
            }
        }

        dd('@completato inserimento piani');
    }
}
