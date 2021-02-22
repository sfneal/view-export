<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Traits\PdfExportValidations;

class PdfExportFromViewTest extends TestCase
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

        $this->exporter = PdfExportService::fromView(
            view('test')
        )->render();
    }
}
