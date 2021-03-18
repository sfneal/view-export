<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportService;

class PdfExportFromHtmlTest extends PdfTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = PdfExportService::fromHtml(file_get_contents(base_path('tests/resources/html/test.html')));
    }
}
