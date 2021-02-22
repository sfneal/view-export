<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Pdf\PdfExportService;
use Sfneal\ViewExport\Tests\Traits\PdfExportValidations;

class PdfExportFromViewDataTest extends TestCase
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

        $this->renderer = PdfExportService::fromViewData('test', ['string'=>"Here's a string!"]);
    }
}
