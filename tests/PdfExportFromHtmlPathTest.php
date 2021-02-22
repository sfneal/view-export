<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Traits\PdfExportValidations;

class PdfExportFromHtmlPathTest extends TestCase
{
    use PdfExportValidations;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = PdfExportService::fromHtmlFile(base_path('tests/resources/html/test.html'));
    }
}
