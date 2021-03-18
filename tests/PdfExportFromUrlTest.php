<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportService;

class PdfExportFromUrlTest extends PdfTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = PdfExportService::fromHtmlFile('http://example.com/');
    }
}
