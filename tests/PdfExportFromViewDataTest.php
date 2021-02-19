<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Pdf\Utils\PdfExporter;
use Sfneal\ViewExport\Tests\Traits\InitializeExporter;

class PdfExportFromViewDataTest extends TestCase
{
    use InitializeExporter;

    /**
     * Setup the test environment.
     *
     * @return void
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->exporter = PdfExportService::fromViewData('test', ['string'=>"Here's a string!"]);
    }
}
