<?php

namespace Bavyhappy\NovaCashierOverviewPlanDetail\Providers;

use Bavyhappy\NovaCashierOverviewPlanDetail\Console\SyncStripePlans;
use Bavyhappy\NovaCashierOverviewPlanDetail\Console\SyncStripeProducts;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CashierOverviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerPublishing();
        $this->registerCommands();

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-cashier-overview-plan-details', __DIR__ . '/../../dist/js/tool.js');
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->namespace('Bavyhappy\NovaCashierOverviewPlanDetail\Http\Controllers')
            ->prefix('nova-vendor/nova-cashier-overview-plan-details')
            ->group(__DIR__ . '/../../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the package migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../database/migrations' => $this->app->databasePath('migrations'),
            ], 'cashier-overview-details-migrations');
        }
    }

    /**
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncStripePlans::class,
                SyncStripeProducts::class
            ]);
        }
    }
}
