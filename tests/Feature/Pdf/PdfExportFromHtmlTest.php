<?php

namespace Sfneal\ViewExport\Tests\Feature\Pdf;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\PdfTestCase;

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
