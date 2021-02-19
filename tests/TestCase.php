<?php

namespace Sfneal\ViewExport\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\ViewExport\Providers\ViewExportServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ViewExportServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(__DIR__ . '/../');
        $app['config']->set('view-export.chroot', $app->basePath().'/vendor/sfneal/dompdf');
        chmod(config('view-export.chroot'), 0755);
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        View::addLocation(__DIR__.'/resources/views');
    }
}
