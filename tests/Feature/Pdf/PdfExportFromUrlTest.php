<?php

namespace Sfneal\ViewExport\Tests\Feature\Pdf;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\PdfTestCase;

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

        $this->renderer = PdfExportService::fromHtmlFile('https://example.com/');
    }
}
