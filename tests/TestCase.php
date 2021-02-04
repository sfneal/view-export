<?php


namespace Sfneal\ViewExport\Tests;


use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
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
