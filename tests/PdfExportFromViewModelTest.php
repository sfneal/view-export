<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Traits\PdfExportValidations;
use Sfneal\ViewExport\Tests\ViewModels\TestViewModel;

class PdfExportFromViewModelTest extends TestCase
{
    use PdfExportValidations;

    /**
     * Setup the test environment.
     *
     * @return void
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->exporter = PdfExportService::fromViewModel(
            new TestViewModel()
        )->render();
    }
}
