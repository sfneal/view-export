<?php

namespace Sfneal\ViewExport\Tests\Feature\Pdf;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\PdfTestCase;

class PdfExportFromViewWithTest extends PdfTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->renderer = PdfExportService::fromView(view('test', ['string'=>"Here's a string!"]));
    }
}
