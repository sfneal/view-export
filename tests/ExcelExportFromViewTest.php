<?php

namespace Sfneal\ViewExport\Tests;

use Sfneal\ViewExport\Excel\ExcelExportService;

class ExcelExportFromViewTest extends ExcelTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->renderer = ExcelExportService::fromView(view('test'));
    }
}
