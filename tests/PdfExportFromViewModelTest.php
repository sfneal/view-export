<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\ViewModels\TestViewModel;

class PdfExportFromViewModelTest extends PdfTestCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = PdfExportService::fromViewModel(new TestViewModel());
    }
}
