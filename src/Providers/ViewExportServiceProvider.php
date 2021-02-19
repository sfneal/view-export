<?php

namespace Sfneal\ViewExport\Providers;

use Illuminate\Support\ServiceProvider;

class ViewExportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any ViewExport services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../../config/view-export.php' => config_path('view-export.php'),
        ], 'config');
    }

    /**
     * Register any ViewExport services.
     *
     * @return void
     */
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../../config/view-export.php', 'view-export');
    }
}
