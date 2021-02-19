<?php

namespace Sfneal\ViewExport\Tests;

use Dompdf\Exception;
use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Traits\InitializeExporter;

class PdfExportFromHtmlPathTest extends TestCase
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

        $this->exporter = PdfExportService::fromHtmlPath(base_path('tests/resources/html/test.html'));
    }
}
