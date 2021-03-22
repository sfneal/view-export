<?php

namespace Sfneal\ViewExport\Tests\Pdf;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Assets\ViewModels\TestViewModel;

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
